MiniSuite 1.2.0
===============

MiniSuite is a very concise and flexible unit testing tool.
Nothing to learn about.
Nice reports.
No headaches.

Installing
----------

You can download the class files (located in `src/`) or install MiniSuite with [Composer](https://getcomposer.org/) :

```json
{
    "require": {
        "pyrsmk/minisuite": "1.2.*"
    }
}
```

Contexts
--------

MiniSuite currently supports CLI and HTTP contexts.

```php
// Will print reports for CLI
$minisuite=new MiniSuite\Cli('My Test Suite');
```

```php
// Will print reports for browsers
$minisuite=new MiniSuite\Http('My Test Suite');
```

Run your tests
--------------

The `test()` method can accept any `callable`. If an exception occurs during the test, MiniSuite will quietly handle it and simply fails the test. Here's how to make a test :

```php
$minisuite->test('I have 3 fruits in my basket',function($minisuite){
    $fruits=array('apple','peach','strawberry');
    return count($fruits)==3;
});
```

To run all your tests, add this line :

```php
$minisuite->run();
```

And launch your PHP test file in the command line interface or your browser.

ANSI colors
-----------

By default, MiniSuite uses ANSI colors to display beautiful CLI reports. But Windows does not support them natively. Disable those colors and have a boring report by :

```php
$minisuite->disableAnsiColors();
```

Grouping
--------

For a better test report, it should be a good idea to group your tests. Per example, for the CLI context :

```php
$minisuite=new MiniSuite\Cli('My Test Suite');
$minisuite->disableAnsiColors();

$minisuite->group('Group some tests',function($minisuite){
    $minisuite->test('I have 3 fruits in my basket',function($minisuite){
        $fruits=array('apple','peach','strawberry');
        return count($fruits)==3;
    });
    $minisuite->test('And 5 vegetables',function($minisuite){
        $vegetables=array('celery','potato','cabbage','endive','radicchio');
        return count($vegetables)==5;
    });
    $minisuite->test('And 15 candies',function($minisuite){
        $candies=array();
        return count($candies)==15;
    });
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

Print additional messages
-------------------------

If needed, you can display useful messages with `info()` and `error()` methods :

```php
$minisuite->test('Some test',function($minisuite){
    try{
        $minisuite->info('Will print an info');
        return true;
    }
    catch(\Exception $e){
        $minisuite->error('Will print an error');
        return false;
    }
});
```

Write your own report objects
-----------------------------

Writing your own objects to have another report for another context, or to beautify an existing report, is pretty simple. We encourage you to take a look at `MiniSuite\Cli` and `MiniSuite\Http` classes to quickly see how it works.

License
-------

MiniSuite is released under the MIT license.
