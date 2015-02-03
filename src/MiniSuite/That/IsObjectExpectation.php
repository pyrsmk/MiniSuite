<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is an object
*/
class IsObjectExpectation extends AbstractExpectation{
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value){
		if(!is_object($value)){
			$value=self::format($value);
			throw new \Exception("should be an object but instead saw '$value'");
		}
	}

}