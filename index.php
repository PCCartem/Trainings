<?php 
require_once("vendor/autoload.php");
use App\Site;

	$config = require(__DIR__ . '/config/web.php');
	$app = Site::getInstance($config);
	


	
?>