<?php 

namespace App;

class Base
{	
	protected $dbh;

	public function __construct($settings)
	{
		$this->dbh = new \PDO('mysql:host=localhost;dbname=test', $settings['user'], $settings['pass']);
	}

	public function getPosts($category = '')
	{
		if (isset($category)) {
			$sth = $this->dbh->prepare('SELECT t1.id AS id, t1.title AS title, t1.content AS content, t2.name as author, t3.name as category
			 		FROM test t1
			 		LEFT JOIN author t2 ON t1.id_author = t2.id
			 		INNER JOIN category t3 ON t1.id_category = t3.id and t3.name =:category
			 		');
			
		} else {
			$sth = $this->dbh->
			prepare('SELECT t1.id AS id, t1.title AS title, t1.content AS content, t2.name as author, t3.name as category
			 		FROM test t1
			 		LEFT JOIN author t2 ON t1.id_author = t2.id
			 		LEFT JOIN category t3 ON t1.id_category = t3.id
			 		;');
		}
		
		$sth->bindParam(':category', $category);
		$sth->execute();
		$result = $sth->fetchAll();

		return $result;

	}

	public function getPost($id)
	{
		$sth = $this->dbh->prepare('SELECT t1.id AS id, t1.title AS title, t1.content AS content, t2.name as author, t3.name as category
			 		FROM test t1
			 		LEFT JOIN author t2 ON t1.id_author = t2.id
			 		LEFT JOIN category t3 ON t1.id_category = t3.id
			 		WHERE t1.id=:id');
		$sth->bindParam(':id', $id);
		$sth->execute();
		$result = $sth->fetch();
		return $result;
	}
}