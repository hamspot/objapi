<h2 class="title"><?php echo $article->title ?></h2>
 
<p style="font-weight:bold;">Publish Date: <?php echo date('nS F, Y', $article->created_at) ?> (<?php echo Date::time_ago($article->created_at)?>) by <?php echo $article->user->username ?></p>
 
<p><?php echo nl2br($article->body) ?></p>

<hr />
 
<h3 id="comments">Comments</h3>
 
<?php foreach ($article->comments as $comment): ?>
 
   <p><?php echo Html::anchor($comment->website, $comment->name) ?> said "<?php echo $comment->message?>"</p>
 
<?php endforeach; ?>
 
<h3>Write a comment</h3>
 
<?php echo Form::open('article/comment/'.$article->slug) ?>
 
<div class="row">
   <label for="name">Name:</label>
   <div class="input"><?php echo Form::input('name'); ?></div>
</div>
 
<div class="row">
   <label for="website">Website:</label>
   <div class="input"><?php echo Form::input('website'); ?></div>
</div>
 
<div class="row">
   <label for="email">Email:</label>
   <div class="input"><?php echo Form::input('email'); ?></div>
</div>
 
<div class="row">
   <label for="message">Comment:</label>
   <div class="input"><?php echo Form::textarea('message'); ?></div>
</div>
 
<div class="row">
   <div class="input"><?php echo Form::submit('submit'); ?></div>
</div>
 
<?php echo Form::close() ?>
