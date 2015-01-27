MiniSuite 2.0.0
===============

MiniSuite is a very concise and flexible unit testing tool based on the [php-expect](https://bitbucket.org/nunzion/php-expect) library.

Installing
----------

You can download the class files (located in `src/`) or install MiniSuite with [Composer](https://getcomposer.org/) :

```json
{
    "require": {
        "pyrsmk/minisuite": "2.0.*"
    }
}
```

Run your tests
--------------

A test in MiniSuite begins with a call to the `expect()` method. It takes one parameter for the message to display and returns an `Expect` object (go take a look at its [documentation](https://bitbucket.org/nunzion/php-expect)).

```php
$fruits=array('apple','peach','strawberry');

$minisuite=new MiniSuite('My tests');
$minisuite->expect('I have 3 fruits in my basket')->that(count($fruits))->equals(3);
```

All your tests are automatically runned.

Grouping
--------

For a better test report, it should be a good idea to group your tests.

```php
$minisuite=new MiniSuite('My Test Suite');
$minisuite->disableAnsiColors();

$minisuite->group('Group some tests',function($minisuite){
    $fruits=array('apple','peach','strawberry');
    $minisuite->expect('I have 3 fruits in my basket')->that(count($fruits))->equals(3);
    $vegetables=array('celery','potato','cabbage','endive','radicchio');
    $minisuite->expect('And 5 vegetables')->that(count($vegetables))->equals(5);
    $candies=array();
    $minisuite->expect('And 15 candies')->that(count($candies))->equals(15);
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

License
-------

MiniSuite is released under the [MIT license](http://dreamysource.mit-license.org).
