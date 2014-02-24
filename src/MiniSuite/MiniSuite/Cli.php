<?php

namespace MiniSuite;

use MiniSuite;

/*
	 CLI environment

	Author
		Aurélien Delogu (dev@dreamysource.fr)
*/
class Cli extends MiniSuite{

	/*
		Triggered before running tests
	*/
	protected function _beforeTests(){
		echo "\n  \033[1;33m".$this->_name."\n\n";
	}

	/*
		Triggered after running tests
	*/
	protected function _afterTests(){
		echo "\n";
	}

	/*
		Triggered when a test has passed
		
		Parameters
			string $message
	*/
	protected function _testPassed($message){
		echo "      \033[0;32m$message\n";
	}

	/*
		Triggered when a test has failed
		
		Parameters
			string $message
	*/
	protected function _testFailed($message){
		echo "      \033[0;31m$message\n";
	}

}
