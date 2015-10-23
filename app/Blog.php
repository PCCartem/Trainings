<?php 

namespace App;

use App\Base;

class Blog
{
	
	protected static $_init = NULL;
	protected $DB;
	protected $settings = ['user' => 'root', 'pass' => '' ];

	function __construct(){
		$this->DB = new Base($this->settings);
	}

	function __clone() {

	}

	public static function getInstanse()
	{
		if (is_null(self::$_init)) {
			self::$_init = new self();
		}
		return self::$_init;
	}

	public function viewBlog($category)
	{
		$result = $this->DB->getPosts($category);
		return $result;
	}

	public function viewPost($id, $category = '')
	{
		$result = $this->DB->getPost($id);
		return $result;
	}


}
