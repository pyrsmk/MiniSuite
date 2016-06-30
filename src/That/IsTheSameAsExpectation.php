<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is the same as another value
*/
class IsTheSameAsExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value) {
		if(func_num_args() < 2) {
			throw new \Exception('no value has been passed');
		}
		$val = func_get_arg(1);
		if($value !== $val) {
			$value = self::format($value);
			$val = self::format($val);
			throw new \Exception("is not the same as '$val' but '$value'");
		}
	}

}