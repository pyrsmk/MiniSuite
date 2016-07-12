<?php

namespace MiniSuite;

use Closure;

/*
	Verify a value
*/
class That {
	
	/*
		mixed $value
		MiniSuite\Suite $minisuite
		Closure $passed
		Closure $failed
	*/
	protected $value;
	protected $minisuite;
	protected $passed;
	protected $failed;

	/*
		Constructor

		Parameters
			mixed $value
			MiniSuite\Suite $minisuite
			Closure $passed
			Closure $failed
	*/
	public function __construct($value, Suite $minisuite, Closure $passed, Closure $failed) {
		$this->value = $value;
		$this->minisuite = $minisuite;
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
				$class = new $class($this->minisuite);
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