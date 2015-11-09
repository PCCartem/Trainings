<?php 

namespace App;

use Twig_Autoloader;
use Twig_Loader_Filesystem;
use Twig_Environment;

class Site
{
	
	protected static $_init = NULL;
	protected $DB;
	protected $config = NULL;
	protected $user = NULL;
	protected $requestParams = [];
	protected $admin = NULL;

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
	
	$this->requestParams = explode('/', $_GET['uri']);
	$uri = array_shift($this->requestParams);
	if (in_array($uri, $access, 1)) {
		$action = 'action'.ucfirst($uri);
		echo $this->$action();
	} elseif ($uri == '') {
		echo $this->actionIndex();
	} else {
		echo $this->actionNotFound();
	}
	}

	protected function render($tpl, $params = [])
	{
		Twig_Autoloader::register();
		$loader = new Twig_Loader_Filesystem('tpl');
		$twig = new Twig_Environment($loader);
		return $twig->render($tpl.".html.twig", $params);
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionWorks()
	{
		$catWorks = $this->DB->getAll('works_category');
		$works = $this->DB->getAll('works');
		return $this->render('works', ['catWorks' => $catWorks, 'works' => $works]);
	}

	public function actionWork()
	{
		$workId = array_shift($this->requestParams);
		$work = $this->DB->getOne($workId, 'works');
		if (!empty($work)) {
			return $this->render('work1', ['work' => $work]);
		}
		return $this->render('404');
	}

	public function actionBlog()
	{
		$posts = $this->DB->getAll('posts');
		$postsCat = $this->DB->getAll('posts_category');
		return $this->render('blog', ['posts' => $posts, 'postsCat' => $postsCat]);
	}

	public function actionPost()
	{
		$workId = array_shift($this->requestParams);
		$post = $this->DB->getOne($workId, 'posts');
		$posts = $this->DB->getAll('posts');
		$postsCat = $this->DB->getAll('posts_category');
		if (!empty($post)) {
			return $this->render('blogpost', ['post' => $post, 'posts' => $posts, 'postsCat' => $postsCat]);
		}
		return $this->render('404');
		
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
		// TODO Оптимизировать
		if ($_POST["logout"] === 'logout') {
			$this->logout();
			return $this->render('login');
		}
		if ($this->user->logged_in) {
			$this->admin = new Admin($this->user);
			$tpl = $this->admin->getTpl($this->requestParams);
			return $this->render('admin/'.$tpl);
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

		// TODO сделать исключение 404 уже в route()
	public function actionNotFound()
	{
		return $this->render('404');
	}

	public function login()
	{
		return $this->user->loginUser($_POST["username"], $_POST["password"]);
	}

	public function logout()
	{
		return $this->user->logoutUser();
	}



}
