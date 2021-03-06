<?php

use Symfony\Component\ClassLoader\Psr4ClassLoader;

########################################################### Prepare

error_reporting(E_ALL);

require 'vendor/autoload.php';
require '../vendor/autoload.php';

$loader = new Psr4ClassLoader;
$loader->addPrefix('MiniSuite\\', '../src');
$loader->register();

########################################################### Base

$minisuite = new MiniSuite\Suite('Base');

$minisuite->expects('Should pass')->that(true)->equals(true);
$minisuite->expects('Should fail')->that(true)->equals(false);
$minisuite->expects('Extends Chernozem')->that($minisuite instanceOf Chernozem\Container)->equals(true);
$minisuite->expects('Chaining')->that(true)->equals(true)->equals(true);
$minisuite->expects('Values printing (should fail)')->that([1 => 1, 'string' => 'test', 'class' => new Stdclass, 'array' => [1 => 1]])->equals([]);

########################################################### Expectations

$minisuite = new MiniSuite\Suite('Expectations');

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
$minisuite->expects('isArray()')->that([])->isArray();
$minisuite->expects('isNotArray()')->that(null)->isNotArray();
$minisuite->expects('isObject()')->that(new Stdclass)->isObject();
$minisuite->expects('isNotObject()')->that([])->isNotObject();
$minisuite->expects('isResource()')->that(imagecreate(100,100))->isResource();
$minisuite->expects('isNotResource()')->that(null)->isNotResource();

$minisuite->expects('isCallable()')->that($minisuite->protect(function(){}))->isCallable();
$minisuite->expects('isNotCallable()')->that(null)->isNotCallable();
$minisuite->expects('isInstanceOf()')->that(new B)->isInstanceOf('B');
$minisuite->expects('isNotInstanceOf()')->that(new C)->isNotInstanceOf('B');
$minisuite->expects('isTheSameAs()')->that(1)->isTheSameAs(1);
$minisuite->expects('isNotTheSameAs()')->that(1)->isNotTheSameAs('1');
$minisuite->expects('extends()')->that(new B)->extends('A');
$minisuite->expects('doesNotExtend()')->that(new C)->doesNotExtend('A');

$minisuite->expects('throws() [1]')->that($minisuite->protect(function($minisuite) {
	throw new Exception();
}))->throws();

$minisuite->expects('throws() [2]')->that($minisuite->protect(function($minisuite) {
	throw new Excep();
}))->throws('Excep');

$minisuite->expects('doesNotThrow() [1]')->that($minisuite->protect(function($minisuite) {
	
}))->doesNotThrow();

$minisuite->expects('doesNotThrow() [3]')->that($minisuite->protect(function($minisuite) {
	throw new Exception();
}))->doesNotThrow('Excep');

$minisuite->expects('isDefined()')->that(['pwet'=>1],'pwet')->isDefined()->isTheSameAs(1);
$minisuite->expects('isNotDefined()')->that([],0)->isNotDefined();

$minisuite->expects('equals() : types mismatch')
		  ->that($minisuite->protect(function($minisuite) {
			  ob_start();
			  $minisuite->expects('test')->that(new Stdclass)->equals('test');
			  $contents = ob_get_clean();
			  if(strpos($contents, '[x]') !== false) {
				  throw new Exception();
			  }
		  }))
		  ->throws();

$minisuite->expects('doesNotEqual() : types mismatch')
		  ->that($minisuite->protect(function($minisuite) {
			  ob_start();
			  $minisuite->expects('test')->that(new Stdclass)->doesNotEqual('test');
			  $contents = ob_get_clean();
			  if(strpos($contents, '[x]') !== false) {
				  throw new Exception();
			  }
		  }))
		  ->throws();

$minisuite->expects('Unsupported expectation')
		  ->that($minisuite->protect(function($minisuite) {
			  ob_start();
			  $minisuite->expects('test')->that(0)->bliblablou(0);
			  ob_end_clean();
		  }))
		  ->throws();

########################################################### Closure support

$minisuite->expects('Closure support')->that(function($minisuite) {
	return $minisuite;
})->isInstanceOf('MiniSuite\Suite');

########################################################### Hydrate tests

$minisuite->hydrate(function($minisuite) {
	$minisuite['test'] = 72;
});

$minisuite->expects('Hydrate')
		  ->that(function($minisuite) {
			  return $minisuite['test'];
		  })
		  ->equals(72);
