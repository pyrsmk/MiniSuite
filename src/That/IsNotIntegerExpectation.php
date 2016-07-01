<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is not an integer
*/
class IsNotIntegerExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	public function check($value) {
		if(is_int($value)) {
			throw new \Exception('is an integer, but should not');
		}
	}

}