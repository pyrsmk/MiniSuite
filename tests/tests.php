<?php

use Symfony\Component\ClassLoader\Psr4ClassLoader;

########################################################### Prepare

error_reporting(E_ALL);

require 'vendor/autoload.php';
require '../vendor/autoload.php';

$loader = new Psr4ClassLoader;
$loader->addPrefix('MiniSuite\\', '../src');
$loader->register();

$minisuite = new MiniSuite\Suite('MiniSuite');

########################################################### Base

$minisuite->group('Base',function($minisuite){

	$minisuite->expects('Should pass')->that(true)->equals(true);
	$minisuite->expects('Should fail')->that(true)->equals(false);
	$minisuite->expects('Chaining')->that(true)->equals(true)->equals(true);
	$minisuite->expects('Array printing')->that(array(1 => 1, 'test' => 'test'))->equals(1);

});

########################################################### Expectations

$minisuite->group('Expectations',function($minisuite){

	interface A {}
	class B implements A {}
	class C {protected $var=72;}
	class Excep extends Exception{}

	$minisuite->expects('isNull()')->that(null)->isNull();
	$minisuite->expects('isNotNull()')->that(0)->isNotNull();
	$minisuite->expects('isEmpty()')->that('')->isEmpty();
	$minisuite->expects('isNotEmpty()')->that('pwet')->isNotEmpty();

	$minisuite->expects('equals()')->that(72)->equals(72);
	$minisuite->expects('doesNotEqual()')->that(1)->doesNotEqual(2);
	$minisuite->expects('isLessThan()')->that(1)->isLessThan(2);
	$minisuite->expects('isLessThanOrEqual()')->that(1)->isLessThanOrEqual(1);
	$minisuite->expects('isGreaterThan()')->that(2)->isGreaterThan(1);
	$minisuite->expects('isGreaterThanOrEqual()')->that(1)->isGreaterThanOrEqual(1);
	$minisuite->expects('isBetween()')->that(2)->isBetween(1,3);
	$minisuite->expects('isNotBetween()')->that(3)->isNotBetween(1,3);

	$minisuite->expects('isBoolean()')->that(false)->isBoolean();
	$minisuite->expects('isNotBoolean()')->that(0)->isNotBoolean();
	$minisuite->expects('isInteger()')->that(0)->isInteger();
	$minisuite->expects('isNotInteger()')->that(false)->isNotInteger();
	$minisuite->expects('isFloat()')->that(0.2)->isFloat();
	$minisuite->expects('isNotFloat()')->that(1)->isNotFloat();
	$minisuite->expects('isString()')->that('')->isString();
	$minisuite->expects('isNotString()')->that(null)->isNotString();
	$minisuite->expects('isArray()')->that(array())->isArray();
	$minisuite->expects('isNotArray()')->that(null)->isNotArray();
	$minisuite->expects('isObject()')->that(new Stdclass)->isObject();
	$minisuite->expects('isNotObject()')->that(array())->isNotObject();
	$minisuite->expects('isResource()')->that(imagecreate(100,100))->isResource();
	$minisuite->expects('isNotResource()')->that(null)->isNotResource();

	$minisuite->expects('isCallable()')->that(function(){})->isCallable();
	$minisuite->expects('isNotCallable()')->that(null)->isNotCallable();
	$minisuite->expects('isInstanceOf()')->that(new B)->isInstanceOf('B');
	$minisuite->expects('isNotInstanceOf()')->that(new C)->isNotInstanceOf('B');
	$minisuite->expects('isTheSameAs()')->that(1)->isTheSameAs(1);
	$minisuite->expects('isNotTheSameAs()')->that(1)->isNotTheSameAs('1');
	$minisuite->expects('extends()')->that(new B)->extends('A');
	$minisuite->expects('doesNotExtend()')->that(new C)->doesNotExtend('A');

	$minisuite->expects('throws() [1]')->that(function(){throw new Exception();})->throws();
	$minisuite->expects('throws() [2]')->that(function(){throw new Excep();})->throws('Excep');
	$minisuite->expects('doesNotThrow() [1]')->that(function(){})->doesNotThrow();
	$minisuite->expects('doesNotThrow() [2]')->that(function(){throw new Exception();})->doesNotThrow('Excep');

	$minisuite->expects('isDefined()')->that(array('pwet'=>1),'pwet')->isDefined()->isTheSameAs(1);
	$minisuite->expects('isNotDefined()')->that(array(),0)->isNotDefined();

});

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