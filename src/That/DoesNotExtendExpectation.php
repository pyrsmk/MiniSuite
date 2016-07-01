<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value extends the specified class
*/
class DoesNotExtendExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	public function check($value) {
		if(func_num_args() < 2) {
			throw new \Exception('no class has been passed');
		}
		$isObject = new IsObjectExpectation();
		$isObject->check($value);
		$class = func_get_arg(1);
		if(is_subclass_of($value, $class)) {
			$class = $this->format($class);
			throw new \Exception("extends '$class, but should not");
		}
	}

}