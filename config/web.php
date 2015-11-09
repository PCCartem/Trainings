<?php 

$config = [
	'appName' => 'Кулибин',
	'db' => require(__DIR__ . '/db.php'),
	'access' => ['index', 'works', 'work', 'blog', 'post', 'about', 'services', 'contact', 'admin'],
];

return $config;