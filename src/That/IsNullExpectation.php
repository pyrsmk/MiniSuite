<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is null
*/
class IsNullExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value) {
		if(!is_null($value)) {
			$value = self::format($value);
			throw new \Exception("expects to be null but is '$value'");
		}
	}

}