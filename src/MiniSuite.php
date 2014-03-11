<?php

/*
	A mini unit testing tool

	Author
		Aurélien Delogu (dev@dreamysource.fr)
*/
abstract class MiniSuite{

	/*
		string $name
		array $stack
	*/
	private $name;
	private $stack=array();

	/*
		Constructor

		Parameters
			string $name
	*/
	final public function __construct($name='Unit testing suite'){
		$this->name=(string)$name;
	}

	/*
		Add one test to the stack

		Parameters
			string $message
			callable $callable

		Return
			MiniSuite
	*/
	final public function test($message,$callable){
		if(!is_callable($callable)){
			throw new Exception("Second parameter of test() method must be a callable");
		}
		$this->stack[]=array(
			'type'		=> 'test',
			'message' 	=> (string)$message,
			'callable'	=> $callable
		);
		return $this;
	}

	/*
		Group tests

		Parameters
			string $message
			callable $callable

		Return
			MiniSuite
	*/
	final public function group($message,$callable){
		if(!is_callable($callable)){
			throw new Exception("Second parameter of group() method must be a callable");
		}
		$this->stack[]=array(
			'type'		=> 'group-open',
			'message' 	=> (string)$message
		);
		$callable($this);
		$this->stack[]=array(
			'type'		=> 'group-close',
			'message' 	=> (string)$message
		);
		return $this;
	}

	/*
		Print an info message

		Parameters
			string $message

		Return
			MiniSuite
	*/
	final public function info($message){
		$this->_printInfo($message);
		return $this;
	}

	/*
		Print an error message

		Parameters
			string $message

		Return
			MiniSuite
	*/
	final public function error($message){
		$this->_printError($message);
		return $this;
	}
	
	/*
		Run the tests
		
		Return
			MiniSuite
	*/
	final public function run(){
		$this->_beforeTests($this->name);
		foreach($this->stack as $element){
			try{
				switch($element['type']){
					case 'test':
						if($element['callable']($this)){
							$this->_testPassed($element['message']);
						}
						else{
							$this->_testFailed($element['message']);
						}
						break;
					case 'group-open':
						$this->_openGroup($element['message']);
						break;
					case 'group-close':
						$this->_closeGroup($element['message']);
						break;
				}
			}
			catch(\Exception $e){
				$this->_testFailed($element['message']);
			}
		}
		$this->_afterTests($this->name);
		return $this;
	}

	/*
		Triggered before running tests
		
		Parameters
			string $message
	*/
	abstract protected function _beforeTests($message);

	/*
		Triggered after running tests
		
		Parameters
			string $message
	*/
	abstract protected function _afterTests($message);

	/*
		Triggered when opening a group
		
		Parameters
			string $message
	*/
	abstract protected function _openGroup($message);

	/*
		Triggered when closing a group
		
		Parameters
			string $message
	*/
	abstract protected function _closeGroup($message);

	/*
		Triggered when a test has passed
		
		Parameters
			string $message
	*/
	abstract protected function _testPassed($message);
	
	/*
		Triggered when a test has failed
		
		Parameters
			string $message
	*/
	abstract protected function _testFailed($message);
	
	/*
		Print an info message
		
		Parameters
			string $message
	*/
	abstract protected function _printInfo($message);
	
	/*
		Print an error message
		
		Parameters
			string $message
	*/
	abstract protected function _printError($message);
	
}
