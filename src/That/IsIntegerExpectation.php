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
	public function check($value) {
		if(!is_int($value)) {
			$value = $this->format($value);
			throw new \Exception("should be an integer but instead saw '$value'");
		}
	}

}