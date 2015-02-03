<?php

namespace MiniSuite;

/*
	Verify a value
*/
class That{
	
	/*
		Closure $passed
		Closure $failed
		mixed $value
		boolean $error
	*/
	protected $passed;
	protected $failed;
	protected $value;
	protected $error=false;

	/*
		Constructor

		Parameters
			Closure $passed
			Closure $failed
			mixed $value
	*/
	public function __construct(\Closure $passed,\Closure $failed,$value){
		$this->passed=$passed;
		$this->failed=$failed;
		$this->value=$value;
	}

	/*
		Call an expectation

		Parameters
			string $method
			array $arguments
	*/
	public function __call($method,$arguments){
		$class='\MiniSuite\That\\'.ucfirst($method).'Expectation';
		try{
			array_unshift($arguments,$this->value);
			call_user_func_array(array($class,'check'),$arguments);
			$passed=$this->passed;
			$passed();
		}
		catch(\Exception $e){
			$failed=$this->failed;
			$failed($e->getMessage());
			$this->error=true;
		}
		return $this;
	}

}