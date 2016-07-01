<?php

namespace MiniSuite;

use Colors\Color;

/*
	Base suite class
*/
class Suite {

	/*
		Constructor

		Parameters
			string $name
	*/
	public function __construct($name = null) {
		if($name) {
			echo "\n  $name\n\n";
		}
	}
	
	/*
		Run a test
		
		Return
			MiniSuite\Suite
	*/
	public function expects($message) {
		return new Expect(
			function() use($message) {
				echo "    [v] $message\n";
			},
			function($err) use($message) {
				echo "    [x] $message\n",
					 "      $err\n";
			}
		);
	}
	
}
