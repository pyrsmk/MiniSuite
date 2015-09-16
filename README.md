MiniSuite 2.1.2
===============

MiniSuite is a very concise and flexible unit testing tool which aims to have an intuitive/powerful API with a small learning curve.

Installing
----------

You can download the class files (located in `src/`) or install MiniSuite with [Composer](https://getcomposer.org/) :

```json
{
    "require": {
        "pyrsmk/minisuite": "~2.1"
    }
}
```

Write your tests
----------------

MiniSuite does not need you to create a class for each test you want to run, you can write and organize your code as you want. Please note that all tests are runned at call.

```php
$fruits=array('apple','peach','strawberry');

$minisuite=new MiniSuite('My tests');
$minisuite->expects('I have 3 fruits in my basket') // define the expectation message
          ->that(count($fruits))                    // define the value too verify
          ->equals(3);                              // equals expectation
```

You also chain your expectations :

```php
$some_value=72;

$minisuite->expects('Some message')
          ->that($some_value)
          ->isInteger()
          ->isGreaterThan(0)
          ->isLessThanOrEqual(100);
```

Specific tests on array elements are supported too :

```php
$fruits=array('apples'=>12,'peaches'=>7,'strawberries'=>41);

$minisuite->expects('Verify strawberries stock')
          ->that($fruits,'strawberries')
          ->isDefined()
          ->isInteger()
          ->isGreaterThan(0);
```

Grouping
--------

For a better test report, it should be a good idea to group your tests.

```php
$minisuite=new MiniSuite('My Test Suite');

$minisuite->group('Group some tests',function($minisuite){

    $fruits=array('apple','peach','strawberry');
    $vegetables=array('celery','potato','cabbage','endive','radicchio');
    $candies=array();

    $minisuite->expects('I have 3 fruits in my basket')->that(count($fruits))->equals(3);
    $minisuite->expects('And 5 vegetables')->that(count($vegetables))->equals(5);
    $minisuite->expects('And 15 candies')->that(count($candies))->equals(15);

});
```

Will print :

```
My Test Suite

    Group some tests
        Passed : I have 3 fruits in my basket
        Passed : And 5 vegetables
        Failed : And 15 candies
```

Note that group nesting is supported.

Expectations
------------

On all values :

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
- isBetween(`$min`,`$max`) : verify if the value is between the specified values (not included)
- isNotBetween(`$min`,`$max`) : verify if the value is not between the specified values (not included)
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
- throws(`$class`) : if the class parameter is defined, it will verify that the `Closure` (specified with `that()`) throws an exception of the specified class, otherwise it will just verify that an exception has been throwed
- doesNotThrow(`$class`) : if the class parameter is defined, it will verify that the `Closure` does not throw an exception of the specified class, otherwise it will just verify that no exception has been throwed

Array elements have some more available expectations :

- isDefined() : verify if the element is defined
- isNotDefined() : verify if the element is not defined

License
-------

MiniSuite is released under the [MIT license](http://dreamysource.mit-license.org).
