<?php 
	/*
	Этот интерфейс содержит методы для анализа строк на полиндромы и подполиндромы.
	*/
abstract class PolindromsAbstract
{
	/*
	Выполняет анализ строки на подполиндромы
	*/
	abstract protected function analis($workStruct);

	/*
	Проверяет строку на то является ли она полиндромом
	*/
	abstract protected function checkOfPolindrom($string);

	/*
	Создает уструктуру строки
	В структуре указывается нумерация символов,
	является ли конкретный символ заглавным(верхний регистр),
	также указывается является ли символ пробелом.
	*/
	abstract protected function createStructureStr($string);

	/*
	Восстанавливает сроку в исходный вид, расставляет пробелы, 
	переводит символы в нужный регистр.
	*/
	abstract protected function restoreStr();

	/*
	Переводит строку в формат необходимый для работы, выполняется послесоставления структуры.
	*/
	abstract protected function convertStr();
}