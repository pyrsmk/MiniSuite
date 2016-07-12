<?php

namespace MiniSuite;

use Closure;

/*
	Expect object
*/
class Expect {
	
	/*
		MiniSuite\Suite $minisuite
		Closure $passed
		Closure $failed
	*/
	protected $minisuite;
	protected $passed;
	protected $failed;

	/*
		Constructor

		Parameters
			MiniSuite\Suite $minisuite
			Closure $passed
			Closure $failed
	*/
	public function __construct(Suite $minisuite, Closure $passed, Closure $failed) {
		$this->minisuite = $minisuite;
		$this->passed = $passed;
		$this->failed = $failed;
	}

	/*
		Define the value to check

		Parameters
			mixed $value
			integer, string $index

		Return
			MiniSuite\That
	*/
	public function that($value, $index = null) {
		// Execute the closure and get the value
		if($value instanceof Closure) {
			$value = $value($this->minisuite);
		}
		// Extract the value
		else if($value instanceof \Chernozem\Value) {
			$value = $value->getRawValue();
		}
		// Verify the value
		if($index === null) {
			return new That($value, $this->minisuite, $this->passed, $this->failed);
		}
		else {
			return new ThatElement($value, $index, $this->minisuite, $this->passed, $this->failed);
		}
	}


}