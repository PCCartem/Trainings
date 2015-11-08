<?php 

$config = [
	'appName' => 'Кулибин',
	'db' => require(__DIR__ . '/db.php'),
	'access' => ['index', 'works', 'blog', 'about', 'services', 'contact', 'admin'],
];

return $config;