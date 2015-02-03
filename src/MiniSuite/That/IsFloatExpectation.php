<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is a float number
*/
class IsFloatExpectation extends AbstractExpectation{
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value){
		if(!is_float($value)){
			$value=self::format($value);
			throw new \Exception("should be a float number but instead saw '$value'");
		}
	}

}