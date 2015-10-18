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
	public function doIt($str)
	{
	    $this->str = $str;
	    /*
	    Проверяет строку на полиндром, 
	    если она является полиндромом, возвращает её
	    */
	    if ($this->checkOfPolindrom($this->str) === TRUE) {
	        return $this->str;
	    }
	    /*
	    Создаем структуру, анализируем её, 
	    возвращаем самый большой подполиндром
	    */
	    $this->structre = $this->createStructureStr($this->str);
	    $this->str = $this->analis($this->structre);
		return $this->str;
	}

	/*
	Выполняет анализ строки на подполиндромы
	*/
	protected function analis()
	{
		# code...
	}

	/*
	Проверяет строку на то является ли она полиндромом
	*/
	protected function checkOfPolindrom($string)
	{
		if ($string === $this->mbStrrev($string)) {
		    return TRUE;
		}
		return FALSE;
	}

	/*
	Создает уструктуру строки
	В структуре указывается нумерация символов,
	является ли конкретный символ заглавным(верхний регистр),
	также указывается является ли символ пробелом.
	*/
	protected function createStructureStr()
	{
		# code...
	}

	/*
	Восстанавливает сроку в исходный вид, расставляет пробелы, 
	переводит символы в нужный регистр.
	*/
	protected function restoreStr()
	{
		# code...
	}

	/*
	Переводит строку в формат необходимый для работы, выполняется послесоставления структуры.
	*/
	protected function convertStr()
	{
		# code...
	}
	
	protected function mbStrrev($string)
	{
	    $mb_strrev = '';
        for($i = mb_strlen($string, "UTF-8"); $i >= 0; $i--){
        $mb_strrev .= mb_substr($string, $i, 1, "UTF-8");
        }
        return $mb_strrev;
	}
}