<?php

namespace MiniSuite;

/*
	Verify an array element value
*/
class ThatElement extends That{
	
	/*
		array $array
	*/
	protected $array;
	protected $index;

	/*
		Constructor

		Parameters
			Closure $passed
			Closure $failed
			array $array
			integer, string $index
	*/
	public function __construct(\Closure $passed,\Closure $failed,array $array,$index){
		if(isset($array[$index])){
			parent::__construct($passed,$failed,$array[$index]);
		}
		else{
			parent::__construct($passed,$failed,null);
		}
		$this->array=$array;
		$this->index=$index;
		$this->value=isset($array[$index])?$array[$index]:null;
	}

	/*
		Call an expectation

		Parameters
			string $method
			array $arguments
	*/
	public function __call($method,$arguments){
		$class='\MiniSuite\That\\'.ucfirst($method).'Expectation';
		if(class_exists($class)){
			parent::__call($method,$arguments);
		}
		else{
			$class='\MiniSuite\ThatElement\\'.ucfirst($method).'Expectation';
			try{
				array_unshift($arguments,$this->array,$this->index);
				call_user_func_array(array($class,'check'),$arguments);
				$passed=$this->passed;
				$passed();
			}
			catch(\Exception $e){
				$failed=$this->failed;
				$failed($e->getMessage());
			}
		}
		return $this;
	}

}