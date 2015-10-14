<?php 
require_once("autoloader.php");
use App\Registry;
use App\Object;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Blog</title>
</head>
<body>
	<?php 
		Registry::setValue('name', 'Vasya');
		echo "Привет ". Registry::getValue('name'). "<br>";
		Registry::setObject(new Object('test'));
		echo Registry::getObject('test')->getId();
	 ?>
</body>
</html>


