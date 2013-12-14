<h2>Viewing #<?php echo $article->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $article->title; ?></p>
<p>
	<strong>Slug:</strong>
	<?php echo $article->slug; ?></p>
<p>
	<strong>Summary:</strong>
	<?php echo $article->summary; ?></p>
<p>
	<strong>Body:</strong>
	<?php echo $article->body; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $article->user_id; ?></p>

<?php echo Html::anchor('admin/articles/edit/'.$article->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/articles', 'Back'); ?>