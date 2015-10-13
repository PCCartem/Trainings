<?php 
require_once("autoloader.php");

use App\Blog;
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Post</title>
</head>
<body>

	<?php 
	$blog = Blog::getInstanse();
	$post = $blog->viewPost($_GET['id']);
		echo '<article>
			<h2>'.$post['title'].'</h2>
			<div>'.$post['content'].'</div>
			<div>'.$post['category'].'</div>
			<div>'.$post['author'].'</div>
		</article>';
	?>
	
</body>
</html>