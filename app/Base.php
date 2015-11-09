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

	/**
	 * Функция получает все данные из таблицы. ОСТОРОЖНО! Переменная $table без фильтрации
	 * Использовать только внутри движка!
	 * @param String $table Имя таблицы
	 * @return Array $result Массив дааных из таблицы
	 */
	public function getAll($table)
	{
		$sth = $this->dbh->prepare("SELECT * FROM $table");
		$sth->execute();
		$result = $sth->fetchAll();
		if (!empty($result)) {
			return $result;
		} else {
			return FALSE;
		}
	}

	/**
	 * Функция получает все данные из таблицы для записи с $id. ОСТОРОЖНО! Переменная $table без фильтрации
	 * Использовать только внутри движка!
	 * @param int $id ид записи
	 * @param String $table Имя таблицы
	 * @return Array $result Массив дааных из таблицы
	 */
	public function getOne($id, $table)
	{
		$sth = $this->dbh->prepare("SELECT * FROM $table WHERE id=:id");
		$sth->bindParam(':id', $id);
		$sth->execute();
		$result = $sth->fetch();
		if (!empty($result)) {
			return $result;
		} else {
			return FALSE;
		}
	}
}