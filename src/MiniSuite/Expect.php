<?php

namespace MiniSuite;

/*
	Nunzion\Expect wrapper
*/
class Expect{
	
	/*
		Closure $passed
		Closure $failed
		Nunzion\Expect $expect
	*/
	protected $passed;
	protected $failed;
	protected $expect;

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
		Wrap that() method

		Parameters
			mixed $value

		Return
			MiniSuite\Expect
	*/
	public function that($value){
		$this->expect=\Nunzion\Expect::that($value);
		return $this;
	}

	/*
		Call an assertion

		Parameters
			string $name
			array $arguments

		Return
			MiniSuite\Expect
	*/
	public function __call($name,$arguments){
		if(!method_exists($this->expect,$name)){
			throw new \Exception("Unsupported '$name' assertion");
		}
		try{
			$this->expect=call_user_func_array(array($this->expect,$name),$arguments);
			$passed=$this->passed;
			$passed();
		}
		catch(\Exception $e){
			$failed=$this->failed;
			$failed($e);
		}
		return $this;
	}


}