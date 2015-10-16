<?php 
require_once('PolindromsInterface.php');
require_once('PolindromsAbstract.php');

class Polindroms extends PolindromsAbstract implements PolindromsInterface 
{

	public $str;
	public $structre;
	public $polinroms;
	/*
	Главный метод который инкапсулирует реализацию всех остальных методов.
	*/
	public function doIt()
	{
		return;
	}

	/*
	Выполняет анализ строки на подполиндромы
	*/
	public function analis()
	{
		# code...
	}

	/*
	Проверяет строку на то является ли она полиндромом
	*/
	public function checkOfPolindrom()
	{
		# code...
	}

	/*
	Создает уструктуру строки
	В структуре указывается нумерация символов,
	является ли конкретный символ заглавным(верхний регистр),
	также указывается является ли символ пробелом.
	*/
	public function createStructureStr()
	{
		# code...
	}

	/*
	Восстанавливает сроку в исходный вид, расставляет пробелы, 
	переводит символы в нужный регистр.
	*/
	public function restoreStr()
	{
		# code...
	}

	/*
	Переводит строку в формат необходимый для работы, выполняется послесоставления структуры.
	*/
	public function convertStr()
	{
		# code...
	}
}