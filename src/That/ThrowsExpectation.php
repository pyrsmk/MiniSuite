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
	static public function check($value) {
		IsCallableExpectation::check($value);
		$class = func_num_args() >= 2 ? func_get_arg(1) : null;
		$error = null;
		try{
			call_user_func($value);
			if($class === null) {
				$error = 'should throw an exception';
			}
			else {
				$class = self::format($class);
				$error = "should throw a '$class' exception";
			}
		}
		catch(\Exception $e) {
			if($class !== null && !($e instanceof $class)) {
				$class = self::format($class);
				$error = "should throw a '$class' exception but instead saw '".get_class($e)."'";
			}
		}
		if($error) {
			throw new \Exception($error);
		}
	}

}