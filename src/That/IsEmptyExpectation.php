<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is empty
*/
class IsEmptyExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	public function check($value) {
		if(!empty($value)) {
			$value = $this->format($value);
			throw new \Exception("is not empty but equals to '$value'");
		}
	}

}