<?php

namespace MiniSuite;

use Closure;

/*
	Verify an array element value
*/
class ThatElement extends That {
	
	/*
		array $array
	*/
	protected $array;
	protected $index;

	/*
		Constructor

		Parameters
			array $array
			integer, string $index
			Closure $passed
			Closure $failed
	*/
	public function __construct(array $array, $index, Closure $passed, Closure $failed) {
		if(isset($array[$index])) {
			parent::__construct($array[$index], $passed, $failed);
		}
		else{
			parent::__construct(null, $passed, $failed);
		}
		$this->array = $array;
		$this->index = $index;
	}

	/*
		Call an expectation

		Parameters
			string $method
			array $arguments
	*/
	public function __call($method, $arguments) {
		$class = '\MiniSuite\ThatElement\\'.ucfirst($method).'Expectation';
		if(!class_exists($class)) {
			parent::__call($method, $arguments);
		}
		else {
			try {
				$class = new $class;
				array_unshift($arguments, $this->array, $this->index);
				call_user_func_array(array($class, 'check'), $arguments);
				$passed = $this->passed;
				$passed();
			}
			catch(\Exception $e) {
				$failed = $this->failed;
				$failed($e->getMessage());
			}
		}
		return $this;
	}

}