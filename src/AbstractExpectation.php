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
		else if(is_array($value)) {
			return '['.implode(', ', array_map(
				function ($v, $k) { return sprintf("%s => %s", $k, $v); },
				$value,
				array_keys($value)
			)).']';
		}
		else if(is_bool($value)) {
			return $value ? 'true' : 'false';
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