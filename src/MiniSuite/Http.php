<?php

namespace MiniSuite;

use MiniSuite;

/*
	HTTP environment

	Author
		Aurélien Delogu (dev@dreamysource.fr)

*/
class Http extends MiniSuite{

	/*
		integer $tabs
	*/
	protected $tabs=1;

	/*
		Triggered before running tests
		
		Parameters
			string $message
	*/
	protected function _beforeTests($message){
		echo '<!DOCTYPE html>
		<html>
			<head>
				<title>'.$message.'</title>
				<meta charset="utf-8">
			</head>
	  		<body>
	  			<h1>'.$message.'</h1>
	  			<ul style="margin:0;padding:0;list-style-type:none;">';
	}

	/*
		Triggered after running tests
		
		Parameters
			string $message
	*/
	protected function _afterTests($message){
		echo '</ul></body></html>';
	}

	/*
		Triggered when opening a group
		
		Parameters
			string $message
	*/
	protected function _openGroup($message){
		echo '<li style="padding-top:1em;padding-left:'.(++$this->tabs).'em;">'.$message.'</li>';
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
		echo '<li style="padding-left:'.($this->tabs+1).'em;color:green;">'.$message.'</li>';
	}

	/*
		Triggered when a test has failed
		
		Parameters
			string $message
	*/
	protected function _testFailed($message){
		echo '<li style="padding-left:'.($this->tabs+1).'em;color:red;">'.$message.'</li>';
	}

}
