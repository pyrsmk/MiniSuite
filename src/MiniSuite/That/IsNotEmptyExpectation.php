<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is not empty
*/
class IsNotEmptyExpectation extends AbstractExpectation{
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value){
		if(empty($value)){
			throw new \Exception('is empty, but should not');
		}
	}

}