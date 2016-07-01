<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is not a string
*/
class IsNotStringExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	public function check($value) {
		if(is_string($value)) {
			throw new \Exception('is a string, but should not');
		}
	}

}