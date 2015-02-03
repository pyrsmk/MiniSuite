<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is an instance of the specified class
*/
class IsNotInstanceOfExpectation extends AbstractExpectation{
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value){
		$class=func_get_arg(1);
		if($value instanceof $class){
			throw new \Exception("is an instance of '$class', but should not");
		}
	}

}