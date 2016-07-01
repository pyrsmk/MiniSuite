<?php

namespace MiniSuite;

use Closure;

/*
	Verify a value
*/
class That {
	
	/*
		Closure $passed
		Closure $failed
		mixed $value
	*/
	protected $passed;
	protected $failed;
	protected $value;

	/*
		Constructor

		Parameters
			mixed $value
			Closure $passed
			Closure $failed
	*/
	public function __construct($value, Closure $passed, Closure $failed) {
		$this->value = $value;
		$this->passed = $passed;
		$this->failed = $failed;
	}

	/*
		Call an expectation

		Parameters
			string $method
			array $arguments
	*/
	public function __call($method, $arguments) {
		$class = '\MiniSuite\That\\'.ucfirst($method).'Expectation';
		if(!class_exists($class)) {
			throw new \Exception("unsupported '$method' expectation");
		}
		else {
			try {
				$class = new $class;
				array_unshift($arguments, $this->value);
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