<?php 

namespace App;

use App\Base;
use App\SimpleUsers;

class Site
{
	
	protected static $_init = NULL;
	protected $DB;
	protected $config = NULL;
	protected $user = NULL;

	protected function __construct($config){
		$this->config = $config;
		$this->DB = new Base($this->config['db']);
		$this->user = new SimpleUsers($this->config['db']);
		$this->route($this->config["access"]);
	}

	protected function __clone() {

	}

	public static function getInstance($config)
	{
		if (is_null(self::$_init)) {
			self::$_init = new self($config);
		}
		return self::$_init;
	}

	protected function route($access)
	{
	$uri = explode('/', $_GET['uri']);
	if (in_array($uri[0], $access, 1)) {
		$action = 'action'.ucfirst($uri[0]);
		echo $this->$action();
	} elseif ($uri[0] == '') {
		echo $this->actionIndex();
	} else {
		echo $this->actionNotFound();
	}
	}

	protected function render($tpl, $params = [])
	{
		\Twig_Autoloader::register();
		$loader = new \Twig_Loader_Filesystem('tpl');
		$twig = new \Twig_Environment($loader);

		return $twig->render($tpl.".html.twig", $params);
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionWorks()
	{
		return $this->render('works');
	}

	public function actionBlog()
	{
		return $this->render('blog');
	}

	public function actionAbout()
	{
		return $this->render('about');
	}

	public function actionServices()
	{
		return $this->render('services');
	}

	public function actionContact()
	{
		return $this->render('contact');
	}

	public function actionAdmin()
	{
		// Оптимизировать
		if ($_POST["logout"] === 'logout') {
			$this->logout();
			return $this->render('login');
		}
		if ($this->user->logged_in) {
			return $this->render('admin');
		}
		if(!empty($_POST["username"]) )
		{
			$res = $this->login();
			if(empty($res))
				return $this->render('login');
			else
			{
				return $this->render('admin');
			}
		} 


		return $this->render('login');
	}

	public function login()
	{
		return $this->user->loginUser($_POST["username"], $_POST["password"]);
	}

	public function logout()
	{
		return $this->user->logoutUser();
	}

	// TODO сделать исключение 404 уже в route()
	public function actionNotFound()
	{
		return $this->render('404');
	}

	


}
