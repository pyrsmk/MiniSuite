MiniSuite 5.0.0
===============

MiniSuite is a very concise and flexible unit testing tool which aims to have an intuitive and procedural API. The reports are made to be simple to read.

![A MiniSuite report](https://github.com/pyrsmk/MiniSuite/raw/master/screenshot.jpg)

Installing
----------

Pick up the source or install it with [Composer](https://getcomposer.org/) :

```
composer require pyrsmk/minisuite
```

Basics
------

MiniSuite does not need you to create a class for each test you want to run, you can write and organize your code as you want. Please note that all tests are runned when they're called.

```php
$fruits = ['apple', 'peach', 'strawberry'];

$minisuite = new MiniSuite\Suite('My tests');
$minisuite->expects('I have 3 fruits in my basket') // define the expectation message
          ->that(count($fruits))                    // define the value to verify
          ->equals(3);                              // 'equals' expectation
```

You can also chain your expectations :

```php
$some_value = 72;

$minisuite->expects('Some message')
          ->that($some_value)
          ->isInteger()
          ->isGreaterThan(0)
          ->isLessThanOrEqual(100);
```

Specific tests on array elements are supported too :

```php
$fruits = ['apples' => 12, 'peaches' => 7, 'strawberries' => 41];

$minisuite->expects('Verify strawberries stock')
          ->that($fruits, 'strawberries')
          ->isDefined()
          ->isInteger()
          ->isGreaterThan(0);
```

Closure support
---------------

MiniSuite support closures to execute more taks when verifying values :

```php
$minisuite->expects('Test')
          ->that(function($minisuite) {
		  	return 72;
		  })
          ->equals(72);
```

Closures are automatically executed when they are passed to `that()`. If you need the closure value to not being run, like with `throws` and `doesNotThrow` expectations, you shoudl protect it with :

```php
$minisuite->expects('Test')
          ->that($minisuite->protect(function($minisuite) {
		  	throws Exception();
		  }))
          ->throws();
```

The MiniSuite container
-----------------------

MiniSuite is based on the [Chernozem container](https://github.com/pyrsmk/Chernozem) and we advise you to read its documentation to be able to use the advanced features, like services support for bigger testing projects.

You can access to the container by specifying a `Closure` in the `that()` method :

```php
$minisuite['fruits'] = ['apples' => 12, 'peaches' => 7, 'strawberries' => 41];

$minisuite->expects('Verify strawberries stock')
          ->that(function($minisuite) {
		  	return count($minisuite['fruits']['strawberries']) > 0;
		  })
          ->equals(true);
```

Hydrate your tests
------------------

For cleaner tests, you should hydrate them with your redundant code, like object creation. Each time a test is run, the `hydrate` function is run too, then you can have clean objects for each test.

```php
$minisuite = new MiniSuite\Suite('My tests');

// Init configuration
$minisuite['conf'] = [
	'path' => 'some/path/'
];

// Set hydrate function
$minisuite->hydrate(function($minisuite) {
	$minisuite['logger'] = new SomeLogger($minisuite['conf']);
});

// Test the logger
$minisuite->expects('Verify logger path')
          ->that(function($minisuite) {
		  	return $minisuite['logger']->getPath();
		  })
          ->equals('some/path/');
```

Available expectations
----------------------

- isNull() : verify if the value is `null`
- isNotNull() : verify if the value is not `null`
- isEmpty() : verify if the value is empty (see the [documentation](http://php.net/manual/en/function.empty.php) for further informations)
- isNotEmpty() : verify if the value is not empty
- equals(`$value`) : verify if the value is equal to the specified parameter
- doesNotEqual(`$value`) : verify if the value is not equal to the specified parameter
- isLessThan(`$value`) : verify if the value is less than the specified parameter
- isLessThanOrEqual(`$value`) : verify if the value is less than or equal the specified parameter
- isGreaterThan(`$value`) : verify if the value is greater than the specified parameter
- isGreaterThanOrEqual(`$value`) : verify if the value is greater than or equal the specified parameter
- isBetween(`$min`, `$max`) : verify if the value is between the specified values (not included)
- isNotBetween(`$min`, `$max`) : verify if the value is not between the specified values (not included)
- isBoolean() : verify if the value is a boolean
- isNotBoolean() : verify if the value is not a boolean
- isInteger() : verify if the value is an integer
- isNotInteger() : verify if the value is not an integer
- isFloat() : verify if the value is a float
- isNotFloat() : verify if the value is not a float
- isString() : verify if the value is a string
- isNotString() : verify if the value is not a string
- isArray() : verify if the value is an array
- isNotArray() : verify if the value is not an array
- isObject() : verify if the value is an object
- isNotObject() : verify if the value is not an object
- isResource() : verify if the value is a resource
- isNotResource() : verify if the value is not a resource
- isCallable() : verify if the value is callable
- isNotCallable() : verify if the value is not callable
- isInstanceOf(`$class`) : verify if the value is an instance of the specified class
- isNotInstanceOf(`$class`) : verify if the value is not an instance of the specified class
- isTheSameAs(`$value`) : verify if the value is the same as the specified value (it's like the `===` operator)
- isNotTheSameAs(`$value`) : verify if the value is not the same as the specified value
- extends(`$class`) : verify if the object extends the specified class
- doesNotExtend(`$class`) : verify if the object does not extend the specified class
- throws(`$class`) : if the class parameter is defined, it will verify that the protected closure throws an exception of the specified class, otherwise it will just verify that an exception has been throwed
- doesNotThrow(`$class`) : if the class parameter is defined, it will verify that the protected closure does not throw an exception of the specified class, otherwise it will just verify that no exception has been throwed

Array elements have some more available expectations :

- isDefined() : verify if the element is defined
- isNotDefined() : verify if the element is not defined

License
-------

MiniSuite is released under the [MIT license](http://dreamysource.mit-license.org).
