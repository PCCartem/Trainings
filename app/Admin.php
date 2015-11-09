<?php 

namespace App;

class Admin
{
	protected $user = NULL;

	public function __construct($user) {
		$this->user = $user;
	}

	public function getTpl($requestParams)
	{
		$tpl = array_shift($requestParams);
		if (!empty($tpl)) {
			return $tpl;
		}
		return 'admin';
	}

	public function adminWorks()
	{
		return $this->render('admin-works');
	}

	public function adminWorkCreate()
	{
		return $this->render('admin-work');
	}

	public function adminWorkEdit()
	{
		return $this->render('admin-work-edit');
	}

	public function adminWorkDelete()
	{
		return $this->render('admin-work-delete');
	}

	public function adminPosts()
	{
		return $this->render('admin-posts');
	}

	public function adminPostCreate()
	{
		return $this->render('admin-posts');
	}

	public function adminPostEdit()
	{
		return $this->render('admin-posts');
	}

	public function adminPostDelete()
	{
		return $this->render('admin-posts');
	}

	public function adminProfile()
	{
		return $this->render('admin-posts');
	}

	public function adminProfileEdit()
	{
		return $this->render('admin-posts');
	}
}