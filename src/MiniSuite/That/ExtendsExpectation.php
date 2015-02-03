<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value extends the specified class
*/
class ExtendsExpectation extends AbstractExpectation{
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	static public function check($value){
		if(func_num_args()<2){
			throw new \Exception('no class has been passed');
		}
		IsObjectExpectation::check($value);
		$class=func_get_arg(1);
		if(!is_subclass_of($value,$class)){
			$class=self::format($class);
			throw new \Exception("does not extend '$class'");
		}
	}

}