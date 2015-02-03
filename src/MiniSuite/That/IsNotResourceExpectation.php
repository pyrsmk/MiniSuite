<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is not a resource
*/
class IsNotResourceExpectation extends AbstractExpectation{
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value){
		if(is_resource($value)){
			throw new \Exception('is a resource, but should not');
		}
	}

}