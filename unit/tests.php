<?php

########################################################### Prepare

error_reporting(E_ALL ^ E_NOTICE);

require __DIR__.'/../src/MiniSuite.php';
require __DIR__.'/../src/MiniSuite/Cli.php';
require __DIR__.'/../src/MiniSuite/Http.php';

if(PHP_SAPI=='cli'){
	$minisuite=new MiniSuite\Cli('MiniSuite');
	$minisuite->disableAnsiColors();
}
else{
	$minisuite=new MiniSuite\Http('MiniSuite');
}

########################################################### Base

$minisuite->test('Should pass',function($minisuite){
	$minisuite->info('Should be an info message');
	return true;
});

$minisuite->test('Should fail',function($minisuite){
	$minisuite->info('Should be an error message');
	return false;
});

########################################################### Group

$minisuite->group('Group - level 1',function($minisuite){
	$minisuite->test('Should pass',function($minisuite){
		return true;
	});
	$minisuite->test('Should fail',function($minisuite){
		return false;
	});
});

########################################################### Nested groups

$minisuite->group('Group - level 1',function($minisuite){
	$minisuite->test('Should pass',function($minisuite){
		return true;
	});
	$minisuite->group('Group - level 2',function($minisuite){
		$minisuite->test('Should pass',function($minisuite){
			return true;
		});
		$minisuite->test('Should fail',function($minisuite){
			return false;
		});
		$minisuite->group('Group - level 3',function($minisuite){
			$minisuite->test('Should pass',function($minisuite){
				return true;
			});
			$minisuite->test('Should fail',function($minisuite){
				return false;
			});
		});
	});
	$minisuite->test('Should fail',function($minisuite){
		return false;
	});
});

########################################################### Run tests

$minisuite->run();