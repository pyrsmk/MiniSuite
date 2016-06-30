<?php

namespace MiniSuite;

use Colors\Color;

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
			MiniSuite\Suite
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
			MiniSuite\Suite
	*/
	public function expects($message) {
		$color = new Color();
		
		return new Expect(
			function() use($message, $color) {
				echo str_repeat('  ', $this->level + 1).$color("OK : $message\n")->green();
			},
			function($err) use($message, $color) {
				echo str_repeat('  ', $this->level + 1).$color("!! : $message ($err)\n")->red();
			}
		);
	}
	
}
