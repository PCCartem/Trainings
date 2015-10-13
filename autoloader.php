<?php
class Autoloader
{
	protected $namespacesMap = [];

	public function addNamespace($namespace, $rootDir)
	{
		if (is_dir($rootDir)) {
			$this->namespacesMap[$namespace] = $rootDir;
			return TRUE;
			} 

			return FALSE;
	}

	public function register()
	{
		spl_autoload_register([$this, 'autoload']);
	}

	protected function autoload($class)
	{
		$pathParts = explode('\\', $class);
		if (is_array($pathParts)) {
			$namespace = array_shift($pathParts);
			if (!empty($this->namespacesMap[$namespace])) {
				$filePath = $this->namespacesMap[$namespace] . implode('/', $pathParts) . '.php';
				require_once $filePath;
				return TRUE;
			} 

			return FALSE;
		}
	}
}
$autoloader = new Autoloader();
$autoloader->addNamespace('App', __DIR__ . '/classes/');
$autoloader->register();