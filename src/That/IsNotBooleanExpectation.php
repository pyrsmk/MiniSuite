<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is not a boolean
*/
class IsNotBooleanExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value) {
		if(is_bool($value)) {
			throw new \Exception('is a boolean, but should not');
		}
	}

}