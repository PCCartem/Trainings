<?php 
require_once("autoloader.php");
use App\Blog;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Blog</title>
</head>
<body>
	<div class="menu">
		<li><a href="/">Главная</a></li>
		<li><a href="/?category=Общее">Общее</a></li>
	</div>
	<h1>Posts</h1>
		<main>
			<?php 
				$blog = Blog::getInstanse();
				$posts = $blog->viewBlog($_GET['category']);

				if ($posts) {
					foreach ($posts as $key => $post) {
					echo '<article>
						<h2><a href="/post.php?id='.$post['id'].'">'.$post['title'].'</a></h2>
						<div>'.mb_strimwidth($post['content'], 0, 100).'</div>
						<div>'.$post['category'].'</div>
						<div>'.$post['author'].'</div>
					</article>';
					}
				}
				

			 ?>	
		</main>
</body>
</html>


