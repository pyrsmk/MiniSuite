<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is an integer
*/
class IsIntegerExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value) {
		if(!is_int($value)) {
			$value = self::format($value);
			throw new \Exception("should be an integer but instead saw '$value'");
		}
	}

}