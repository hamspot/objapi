<?php
class Controller_Admin_Articles extends Controller_Admin{

	public function action_index()
	{
		$data['articles'] = Model_Article::find('all');
		$this->template->title = "Articles";
		$this->template->content = View::forge('admin/articles/index', $data);

	}

	public function action_view($id = null)
	{
		$data['article'] = Model_Article::find($id);

		$this->template->title = "Article";
		$this->template->content = View::forge('admin/articles/view', $data);

	}

	public function action_create()
	{
		// create a new custom view for creating articles
		$view = View::forge('admin/articles/create');

		if (Input::method() == 'POST')
		{
			$val = Model_Article::validate('create');

			if ($val->run())
			{
				$article = Model_Article::forge(array(
					'title' => Input::post('title'),
					'slug' => Input::post('slug'),
					'summary' => Input::post('summary'),
					'body' => Input::post('body'),
					'user_id' => Input::post('user_id'),
				));

				if ($article and $article->save())
				{
					Session::set_flash('success', e('Added article #'.$article->id.'.'));

					Response::redirect('admin/articles');
				}

				else
				{
					Session::set_flash('error', e('Could not save article.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		// pull the list of user accounts into the view
		$view->set_global('users', Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));

		$this->template->title = "Articles";
		$this->template->content = View::forge('admin/articles/create');

	}

	public function action_edit($id = null)
	{
		$view = View::forge('admin/articles/edit');
		$article = Model_Article::find($id);
		$val = Model_Article::validate('edit');

		if ($val->run())
		{
			$article->title = Input::post('title');
			$article->slug = Input::post('slug');
			$article->summary = Input::post('summary');
			$article->body = Input::post('body');
			$article->user_id = Input::post('user_id');

			if ($article->save())
			{
				Session::set_flash('success', e('Updated article #' . $id));

				Response::redirect('admin/articles');
			}

			else
			{
				Session::set_flash('error', e('Could not update article #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$article->title = $val->validated('title');
				$article->slug = $val->validated('slug');
				$article->summary = $val->validated('summary');
				$article->body = $val->validated('body');
				$article->user_id = $val->validated('user_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('article', $article, false);
		}

		$view->set_global('users', Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));
		$this->template->title = "Articles";
		$this->template->content = View::forge('admin/articles/edit');

	}

	public function action_delete($id = null)
	{
		if ($article = Model_Article::find($id))
		{
			$article->delete();

			Session::set_flash('success', e('Deleted article #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete article #'.$id));
		}

		Response::redirect('admin/articles');

	}


}
