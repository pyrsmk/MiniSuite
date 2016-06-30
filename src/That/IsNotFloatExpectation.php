<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is not a float number
*/
class IsNotFloatExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value) {
		if(is_float($value)) {
			throw new \Exception('is a float number, but should not');
		}
	}

}