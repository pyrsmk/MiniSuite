<?php

namespace MiniSuite;

/*
	Expectation abstract class
*/
abstract class AbstractExpectation implements ExpectationInterface {

	/*
		Format a value to a string

		Parameters
			mixed $value

		Return
			String
	*/
	static protected function format($value) {
		if(is_object($value)) {
			return get_class($value);
		}
		if(is_array($value)) {
			return 'Array['.count($value).']';
		}
		else if(is_resource($value)) {
			$type=get_resource_type($value);
			if($type=='Unknown') {
				return 'unknown resource';
			}
			else {
				return $type;
			}
		}
		else{
			return (string)$value;
		}
	}

}