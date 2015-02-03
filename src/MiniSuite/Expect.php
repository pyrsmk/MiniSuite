<?php

namespace MiniSuite;

/*
	Expect object
*/
class Expect{
	
	/*
		Closure $passed
		Closure $failed
	*/
	protected $passed;
	protected $failed;

	/*
		Constructor

		Parameters
			Closure $passed
			Closure $failed
	*/
	public function __construct(\Closure $passed,\Closure $failed){
		$this->passed=$passed;
		$this->failed=$failed;
	}

	/*
		Define the value to check

		Parameters
			mixed $value
			integer, string $index

		Return
			MiniSuite\That
	*/
	public function that($value,$index=null){
		if($index===null){
			return new That($this->passed,$this->failed,$value);
		}
		else{
			return new ThatElement($this->passed,$this->failed,$value,$index);
		}
	}


}