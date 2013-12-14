<?php
class Controller_Article extends Controller_Base
{
	public function action_index()
	{
		$view = View::forge('article/index');
		$view->articles = Model_Article::find('all');
		$this->template->title = 'Article Manager';
		$this->template->content = $view;
	}

	public function action_view($slug)
	{
		$article = Model_Article::find_by_slug($slug, array('related' => array('user','comments')));
		if( !is_object( $article ) ) throw new HttpNotFoundException();
		$this->template->title = $article->title;
		$this->template->content = View::forge('article/view', array(
			'article' => $article,
		));
	}

	public function action_comment($slug)
	{
		$article = Model_Article::find_by_slug($slug);
    
		if (Input::post('name') AND Input::post('email') AND Input::post('message'))
		{
			// create a new comment
			$article->comments[] = new Model_Comment(array(
				'name' => Input::post('name'),
				'website' => Input::post('website'),
				'email' => Input::post('email'),
				'message' => Input::post('message'),
				'user_id' => $this->current_user->id,
			));
       
			// Saving article will save comment
			if ($article->save())
			{
				$comment = end($article->comments);
				Session::set_flash('success', 'Added comment #'.$comment->id.'.');
			}
			else
			{
				Session::set_flash('error', 'Could not save comment.');
			}

			Response::redirect('article/view/'.$slug);
		}
    
		// failed to provide some of the fields and we require them all
		else
		{
			// present the view again because this is just a demo app
			$this->action_view($slug);
		}
	}

}
