<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is a boolean
*/
class IsBooleanExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value) {
		if(!is_bool($value)) {
			$value = self::format($value);
			throw new \Exception("should be a boolean but instead saw '$value'");
		}
	}

}