<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value throws an exception
*/
class ThrowsExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	public function check($value) {
		$isCallable = new IsCallableExpectation($this->minisuite);
		$isCallable->check($value);
		$class = func_num_args() >= 2 ? func_get_arg(1) : null;
		$error = null;
		try {
			$value($this->minisuite);
			if($class === null) {
				$error = 'should throw an exception';
			}
			else {
				$class = $this->format($class);
				$error = "should throw a '$class' exception";
			}
		}
		catch(\Exception $e) {
			if($class !== null && !($e instanceof $class)) {
				$class = $this->format($class);
				$error = "should throw a '$class' exception but instead saw '".get_class($e)."'";
			}
		}
		if($error) {
			throw new \Exception($error);
		}
	}

}