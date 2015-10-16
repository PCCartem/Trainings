<?php 
abstract class FactoryAbstract
{
	protected static $instances = [];

	public static function getInstance()
	{
		$className = static::getClassName();

		if (!(self::$instances[$className] instanceof $className)) {
			self::$instances[$className] = new $className();
		}
		return self::$instances[$className];
	}

	public static function removeInstance($classname)
	{
		$className = static::getClassName();

		if (array_key_exists($className, self::$instances)) {
			unset(self::$instances[$className]);
		}
	}

	final protected static function getClassName()
	{
		return get_called_class();
	}

	final protected function __construct()
	{

	}
	final protected function __clone()
	{

	}
	final protected function __wakeup()
	{

	}
	final protected function __sleep()
	{

	}

}

abstract class Factory extends FactoryAbstract
{
	final public static function getInstance()
	{
		return parent::getInstance();
	}
	final public static function removeInstance()
	{
		return parent::removeInstance();
	}
}

class First extends Factory
{
	public $a = [];

}

class Second extends First
{

}
First::getInstance()->a[] = 1;
Second::getInstance()->a[] = 2;
First::getInstance()->a[] = 3;
Second::getInstance()->a[] = 4;

var_dump(First::getInstance()->a);