<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is an array
*/
class IsArrayExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	public function check($value) {
		if(!is_array($value)) {
			$value = $this->format($value);
			throw new \Exception("should be an array but instead saw '$value'");
		}
	}

}