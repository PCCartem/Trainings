<?php 
require_once('PolindromsInterface.php');
require_once('PolindromsAbstract.php');

class Polindroms extends PolindromsAbstract implements PolindromsInterface 
{

	public $str;
	public $structre;
	public $polindrom;
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
	    $this->createStructureStr($this->str);
	    $workStruct = $this->convertStr();
	    $this->analis($workStruct);
		/*
	    Если после анализа массив пустой то возвращаем 1 символ строки.
	    */
	    if (empty($this->polindrom)) {
	    	$this->polindrom = substr($this->str, 0, 1);
	    }
		return $this->polindrom;
	}

	/*
	Выполняет анализ строки на подполиндромы
	*/
	public function analis($workStruct)
	{
		$podpolindroms = [];
		$strings = [];
		$arrStruct =[];
		unset($workStruct['result']);
		$gCount = count($workStruct);
		
		
		for ($i=$gCount; $i >= 0; $i--) { 
			$c = $gCount - $i;
			$workArr = $workStruct;
			for ($j= $c; $j <= $gCount ; $j++) { 
				$str = "";
				while (mb_strlen($str) < $c) {
					$char = array_values($workArr)[mb_strlen($str)]['char'];
					$struct = array_values($workArr)[mb_strlen($str)]['num'];
					$arrStruct[] = $struct;
					$str .= $char;
					 
					
				}
				if (mb_strlen($str)>1) {
					$strings[] = $str;

				}
				
				array_shift($workArr);
			}
		}
		
		foreach ($strings as $str) {
			if ($this->checkOfPolindrom($str) === TRUE) {
				$polindroms[] = $str;
			}
		}
		
		if ($polindroms) {
			$this->polindrom = array_pop($polindroms);
		}
		
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
	public function createStructureStr($string)
	{
		$len = mb_strlen($string);
		for($i = 0; $i < $len; $i++){
        $this->structre[$i]['char'] = mb_substr($string ,$i,1);
        if (mb_convert_case($this->structre[$i]['char'], MB_CASE_LOWER, "UTF-8")===$this->structre[$i]['char']) {
        	$this->structre[$i]['registr'] = 'b';
        } else {
        	// TODO convert func
        	//$this->structre[$i]['char'] = mb_strtoupper($this->structre[$i]['char'])
        	$this->structre[$i]['registr'] = 't';
        }
        if ($this->structre[$i]['char'] === ' ') 
        	{
        		$this->structre[$i]['type'] = 'space';
        	} 
        	elseif (empty(preg_replace ("/^[^a-zA-ZА-Яа-я0-9 \s]*$/","",$this->structre[$i]['char']))) 
        		{
        			$this->structre[$i]['type'] = 'other-char';
        		}
        		elseif (preg_replace ("/^[^a-zA-ZА-Яа-я0-9 \s]*$/","",$this->structre[$i]['char']))
        			{
        				$this->structre[$i]['type'] = 'char';
        			}
        $this->structre[$i]['num'] = $i;
       // TODO make function filtr for this
        /*if (empty(preg_replace ("/^[^a-zA-ZА-Яа-я0-9 \s]*$/","",$this->structre[$i]['char']))) {
        	unset($this->structre[$i]);
        }*/
        
        
        }

        return $this->structre;
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
	public function convertStr()
	{
		$workStructre = $this->structre;

		$len = count($workStructre);
		$workStructre['result'] = "";
		for($i = 0; $i < $len; $i++) {
        if ($workStructre[$i]['registr'] === 't') {

        	$workStructre[$i]['char'] = mb_strtolower($workStructre[$i]['char']);
        }
        if (($workStructre[$i]['type'] === 'space') OR ($workStructre[$i]['type'] === 'other-char')) 
        	{
        		unset($workStructre[$i]);
        	}
        $workStructre['result'] .= $workStructre[$i]['char'];
        }
        
        return $workStructre;
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




