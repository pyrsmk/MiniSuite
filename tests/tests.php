<?php

use Symfony\Component\Finder\Finder;

########################################################### Prepare

error_reporting(E_ALL);

require 'vendor/autoload.php';
require '../vendor/autoload.php';

$finder=new Finder();
$finder->files()->in('../src');
foreach($finder as $file){
	require_once $file->getRealpath();
}

$minisuite=new MiniSuite('MiniSuite');

########################################################### Base

$minisuite->expects('Should pass')->that(true)->equals(true);
$minisuite->expects('Should fail')->that(true)->equals(false);

########################################################### Levels consistency

$a=0;

$minisuite->group('Levels consistency',function($minisuite) use(&$a){
	$minisuite->group('Level 1',function($minisuite) use(&$a){
		$minisuite->expects('Level 1-1')->that(++$a)->equals(1);
		$minisuite->expects('Level 1-2')->that(++$a)->equals(2);
	});
	$minisuite->expects('Level 2')->that(++$a)->equals(3);
	$minisuite->group('Level 3',function($minisuite) use(&$a){
		$minisuite->expects('Level 3-1')->that(++$a)->equals(4);
		$minisuite->expects('Level 3-2')->that(++$a)->equals(5);
		$minisuite->group('Level 3-3',function($minisuite) use(&$a){
			$minisuite->expects('Level 3-3-1')->that(++$a)->equals(6);
			$minisuite->expects('Level 3-3-2')->that(++$a)->equals(7);
		});
	});
	$minisuite->expects('Level 4')->that(++$a)->equals(8);
});