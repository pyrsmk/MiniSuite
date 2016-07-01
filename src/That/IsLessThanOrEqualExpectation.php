<?php

namespace MiniSuite\That;

use MiniSuite\AbstractExpectation;

/*
	Verify if the value is less than another one or equals to
*/
class IsLessThanOrEqualExpectation extends AbstractExpectation {
	
	/*
		Check if the condition is matched

		Parameters
			mixed $value
	*/
	public function check($value) {
		if(func_num_args() < 2) {
			throw new \Exception('no value has been passed');
		}
		$val = func_get_arg(1);
		if($value > $val) {
			$value = $this->format($value);
			$val = $this->format($val);
			throw new \Exception("should be less than '$val' or equal to but instead saw '$value'");
		}
	}

}