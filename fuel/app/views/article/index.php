<h2 class="heading">Latest Articles</h2>
 
<?php foreach ($articles as $article): ?>
 
   <h3 class="title"><?php echo Html::anchor('article/view/'.$article->slug, $article->title) ?></h3>
    
   <p><?php echo $article->summary ?></p>
 
<?php endforeach; ?>
