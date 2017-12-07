<?php 
$statement = $pdo->prepare("
			SELECT postID, title, post, category, created
			FROM posts
			WHERE monthname(created) = :month AND year(created) = :year
			ORDER BY created DESC
			");

			//GROUP BY MONTH(created)
			$statement->execute(array(
				":month" => $month,
				":year" => $year
			));
			$posts_per_month = $statement->fetchAll(PDO::FETCH_ASSOC);