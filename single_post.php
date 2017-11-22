<?php
require 'session.php';
require "database.php";
require 'head.php';
?>

	<body id="single_post">
		<?php require 'navbar.php';?>
		<main role="main">
			<div class="wrapper">
				<?php
	
	$statement = $pdo->prepare("SELECT * 
	FROM posts 
	JOIN users ON posts.userID = users.id 
	WHERE posts.postID = :postID 
	");
	$statement->execute(array(
		":postID" => $_GET["postID"]
	));
	$single_post = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($single_post as $blogpost) { ?>
					<article class="blogpost">

						<h2 class="center">
							<?=$blogpost['title']?>
						</h2>
						<figure class="blogpost__image">
							<img class="blogpost__image" src="<?= $blogpost['image'] ?>">
						</figure>
						<small class="center">
					By <?=  $blogpost['username'] ?> in
						<?= $blogpost['category'] ?> 
						<?= $blogpost['created'] ?>
				</small>
						<p>
							<?= $blogpost['post'] ?>
						</p>
						<br/><br/>
						<?php include 'edit_buttons.php'?>
					</article>
					<?php } ?>
					<br/>
					<section class="comments_wrapper_container">

						<h3 class="comments_header">Comments</h3>

						<?php if(!isset($_SESSION["user"])){ ?>
						<!-- Comment form if not logged in -->
						<form action="comment_form.php" method="POST" class="comment_form">
							<textarea name="comment" placeholder="Write your comment..." rows="6"></textarea>
							<input type="hidden" name="postID" value=" <?=$_GET['postID']?>">
							<input type="hidden" name="userID" value="0">
							<br /><input type="text" name="name" placeholder="Name">
							<input type="text" name="email" placeholder="Email">
							<br/>
							<input class="comment_submit" type="submit" name="submit" value="Post comment">
						</form>
						<?php } else { ?>
						<!-- Comment form if logged in -->
						<form action="comment_form.php" method="POST" class="comment_form">
							<textarea name="comment" placeholder="Write your comment..." rows="6"></textarea>
							<input type="hidden" name="postID" value=" <?=$_GET['postID']?>">
							<input type="hidden" name="userID" value=" <?=$_SESSION['user']['id']?>">
							<input type="hidden" name="name" value=" <?=$_SESSION['user']['username']?>">
							<input type="hidden" name="email" value=" <?=$_SESSION['user']['email']?>">
							<input class="comment_submit" type="submit" name="submit" value="Post comment">
						</form>
						<?php }	?>
					</div>

					<br/>
					
						<?php
$statement = $pdo->prepare("SELECT * FROM comments  
	WHERE postID = :postID
	ORDER BY commentID DESC");
				   
	$statement->execute(array(
		":postID" => $_GET["postID"]
	));
	$comments = $statement->fetchAll(PDO::FETCH_ASSOC);
				   
	foreach($comments as $comment) { 
 ?>
							<div class="comment">
								<p>
									<?= $comment['comment'] ?>
								</p>
								<small><?=  $comment['name']; ?> </small>
								<small><?= $comment['created']; ?> </small>
								<br/>
							</div>

							<?php } ?>
					</section>
			</div>
			<?php
require "footer.php";
?>