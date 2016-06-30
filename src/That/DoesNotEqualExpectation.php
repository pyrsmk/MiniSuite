<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value does not equal to another value
*/
class DoesNotEqualExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value) {
		if(func_num_args() < 2) {
			throw new \Exception('no value has been passed');
		}
		if($value == func_get_arg(1)) {
			$value = self::format($value);
			throw new \Exception("equals to '$value', but should not");
		}
	}

}