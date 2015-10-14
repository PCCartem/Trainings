<?php 

namespace App;

class Registry
{

	protected static $data = [];
	protected static $objects = [];

	/*
	* Устанавливает значение 
	*/	
	public static function setValue($key, $value)
	{
		if (self::$data[$key] = $value) {
			return TRUE;
		}
		return FALSE;
	}
	
	/*
	* Получает значение 
	*/
	public static function getValue($key)
	{
		if (isset(self::$data[$key])) {
			return self::$data[$key];
		}
		return FALSE;
	}

	final public static function removeValue($key)
	{
		if (isset(self::$data[$key])) {
			unset(self::$data[$key]);
			return TRUE;
		}
		return FALSE;
	}

	/*
	* Устанавливает значение 
	*/	
	public static function setObject(Object $Object)
	{
		if (!(self::$objects[$id] instanceof Object)) {
			self::$objects[$Object->getId()] = $Object;
			
			return TRUE;
		}
		return FALSE;
	}
	
	/*
	* Получает значение 
	*/
	public static function getObject($id)
	{
		if (isset(self::$objects[$id])) {
			return self::$objects[$id];
		}
		return FALSE;
	}
}

class Object
{
	protected $id;
	public function __construct($id)
	{
		$this->id = $id;
	}
	public function getId()
	{
		return $this->id;
	}
}
