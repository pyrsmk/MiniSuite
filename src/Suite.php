<?php

namespace MiniSuite;

/*
	Base suite class
*/
class Suite {

	/*
		integer $level
	*/
	protected $level = 1;

	/*
		Constructor

		Parameters
			string $name
	*/
	public function __construct($name = null) {
		if($name) {
			echo "\n".str_repeat('  ',$this->level)."$name\n\n";
		}
	}

	/*
		Group tests

		Parameters
			string $message
			callable $callable

		Return
			MiniSuite
	*/
	public function group($message, $callable) {
		if(!is_callable($callable)) {
			throw new Exception("Second parameter of group() method must be a callable");
		}
		++$this->level;
		echo "\n".str_repeat('  ',$this->level)."$message\n";
		$callable($this);
		echo "\n";
		--$this->level;
		return $this;
	}
	
	/*
		Run a test
		
		Return
			MiniSuite
	*/
	public function expects($message) {
		return new MiniSuite\Expect(
			function() use($message) {
				echo str_repeat('  ', $this->level + 1)."Passed : $message\n";
			},
			function($err) use($message) {
				echo str_repeat('  ', $this->level + 1)."Failed : $message ($err)\n";
			}
		);
	}
	
}
