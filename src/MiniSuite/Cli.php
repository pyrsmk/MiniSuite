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
		integer $tabs
	*/
	protected $tabs=1;

	/*
		boolean $colors
	*/
	protected $colors=true;

	/*
		Disable ANSI colors (some environments don't support them, like Windows)

		Return
			MiniSuite\Cli
	*/
	public function disableAnsiColors(){
		$this->colors=false;
		return $this;
	}

	/*
		Triggered before running tests
		
		Parameters
			string $message
	*/
	protected function _beforeTests($message){
		if($this->colors){
			echo "\n".str_repeat('  ',$this->tabs)."\033[1;33m$message\n\n";
		}
		else{
			echo "\n".str_repeat('  ',$this->tabs)."$message\n\n";
		}
	}

	/*
		Triggered after running tests
		
		Parameters
			string $message
	*/
	protected function _afterTests($message){
		echo "\n";
	}

	/*
		Triggered when opening a group
		
		Parameters
			string $message
	*/
	protected function _openGroup($message){
		if($this->colors){
			echo "\n".str_repeat('  ',++$this->tabs)."\033[1;35m$message\n";
		}
		else{
			echo "\n".str_repeat('  ',++$this->tabs)."$message\n";
		}
	}

	/*
		Triggered when closing a group
		
		Parameters
			string $message
	*/
	protected function _closeGroup($message){
		--$this->tabs;
	}

	/*
		Triggered when a test has passed
		
		Parameters
			string $message
	*/
	protected function _testPassed($message){
		if($this->colors){
			echo str_repeat('  ',$this->tabs+1)."\033[0;32m$message\n";
		}
		else{
			echo str_repeat('  ',$this->tabs+1)."Passed : $message\n";
		}
	}

	/*
		Triggered when a test has failed
		
		Parameters
			string $message
	*/
	protected function _testFailed($message){
		if($this->colors){
			echo str_repeat('  ',$this->tabs+1)."\033[0;31m$message\n";
		}
		else{
			echo str_repeat('  ',$this->tabs+1)."Failed : $message\n";
		}
	}

}
