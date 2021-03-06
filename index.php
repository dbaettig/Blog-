<?php
require 'partials/session.php';
require 'partials/database.php';
require 'partials/head.php';
require 'logic/index_db.php';
require 'logic/functions.php';

?>

   <body id="blog">
     <?php require 'partials/header.php'; ?>
        <main>
            <div class="wrapper">
               
                <nav class="categorymenu">
                    <ul>
                        <li><a href="single_category.php?news">News</a></li>
                        <li><a href="single_category.php?interior">Interior</a>
                        <li><a href="single_category.php?style">Style</a></li>
                        <li><a href="single_category.php?featured">Featured</a></li>
                    </ul>
                </nav>

        <div class="posts">


<?php foreach($blog as $blogpost) { ?>
		<article class="blogpost index">
			<figure class="blogpost__image">
				<img class="index_image" src="<?= $blogpost['image']?>" alt="<?= $blogpost['alt_text']?>">
			</figure>

			<div class="blogpost__text">
				<div class="blogpost__text--meta">
					<a href="single_post.php?postID=<?= $blogpost['postID'] ?>">
						<h2 class="left">
							<?=$blogpost['title']?>
						</h2>
					</a>

					<small class="left">
						By <?=  $blogpost['username'] ?> in
							<?= $blogpost['category'] ?> 
							<?= $blogpost['created'] ?>

						<br/>

							<?php foreach($comments_toPosts as $comment) { 
								if($comment['postID'] == $blogpost['postID']) {
										echo $comment['number_of_comments'] . " " . "comments";
								}
							 } ?> 
					</small>

					<?php include 'partials/edit_buttons.php';?>
				</div>
				<div class="blogpost__text--bodytext">
					<p><?= substr($blogpost['post'],0,200) . "... " ; ?><a href="single_post.php?postID=<?= $blogpost['postID'] ?>"><span class="readmore">Read more</span></a></p>
					<p class="comment_link right"><a href="single_post.php?postID=<?= $blogpost['postID'] ?>">Comment <i class="fa fa-arrow-right" aria-hidden="true"></i></a></p>
				</div>
			</div>
		</article>
	<?php } ?>	
   </div><!-- close .posts -->

	   <div class="pagination">  
	    <?php
	        $total_records = postamount();
	        require 'partials/pagination.php';
	    ?> 
	    </div>

	    <div class="clear"></div> 

</div><!--wrapper-->

<?php
	require 'partials/footer.php';
?>
