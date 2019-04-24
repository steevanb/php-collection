[![version](https://img.shields.io/badge/version-1.1.0-green.svg)](https://github.com/steevanb/php-typed-array/tree/1.1.0)
[![php](https://img.shields.io/badge/php-^7.1-blue.svg)](https://php.net)
![Lines](https://img.shields.io/badge/code%20lines-535-green.svg)
![Total Downloads](https://poser.pugx.org/steevanb/php-typed-array/downloads)
[![Scrutinizer](https://scrutinizer-ci.com/g/steevanb/php-typed-array/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/steevanb/php-typed-array/)

### php-typed-array

Bored of not knowing value type in array ? You are at the right spot !

With `php-typed-array`, you can type your array values. How ? Cause now you will use object instead of array, who can control their values.

[Changelog](changelog.md)

### Installation

```
composer require steevanb/php-typed-array ^1.0
```

### Typed array available

`IntArray`: can store `int`

`StringArray`: can store `string`

`ObjectArray`: can store `object`

### Usage

/!\ See [Limitations](https://github.com/steevanb/php-typed-array#limitations) before using it, PHP have a lot of limitations with objects as array /!\

Simple usage:
```php
$intArray = new IntArray([1, 2]);
$intArray['key'] = 3;
foreach ($intArray as $key => $int) {
    // do your stuff, you are SURE $int is integer !
}
```

Usefull usage:
```php
function returnInts(): \IntArray
{
    return new \IntArray([1, 2, 3]); 
}

foreach (returnInts() as $key => $int) {
    // do your stuff, you are SURE $int is integer !
}
```

Will throw an `\Exception`, cause `'foo'` is not allowed:
```php
$intArray = new IntArray([1, 2, 'foo']);
```

### Filter values to be uniques

If you want to be sure a value is unique inside your TypedArray, you have to configure `valueAlreadyExistMode`:

```php
// $foo will contain [1, 2, ]
$foo = (new IntArray())
    // default behavior, code here is just for the example
    ->setValueAlreadyExistMode(IntArray::VALUE_ALREADY_EXIST_ADD)
    ->setValues([1, 2, 2]);

// a steevanb\PhpTypedArray\Exception\NonUniqueValueException will be thrown
$foo = (new IntArray())
    // default behavior, code here is just for the example
    ->setValueAlreadyExistMode(IntArray::VALUE_ALREADY_EXIST_EXCEPTION)
    ->setValues([1, 2, 2]);

// $foo will contain [1, 2]
$foo = (new IntArray())
    // default behavior, code here is just for the example
    ->setValueAlreadyExistMode(IntArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
    ->setValues([1, 2, 2]);
```

### Merge values

As PHP badly hint parameters as `array` instead of `iterable` for some internals functions, you can't use `array_merge()` on TypedArray.

Use `TypedArray::merge()` instead.

```php
$foo = new IntArray([1, 2);
// $foo will contain [1, 2, 3];
$foo->merge([3]);
// $foo will contain [1, 2, 3, 4];
$foo->merge(new IntArray([4]);
```

### ObjectArray

If you need to store objects in array, you can use `ObjectArray`.

But if you need to be sure each objects are an instance of something, you can configure it in `__construct()`:

```php
$dateTimeArray = new ObjectArray([new \DateTime()], \DateTime::class);
```

Or you can extend `ObjectArray` and configure it internally:

```php
class DateTimeArray extends ObjectArray
{
    public function __construct(iterable $values = [], bool $uniqueValues = false, bool $exceptionOnNonUniqueValue = false)
    {
        parent::__construct($values, \DateTime::class, $uniqueValues, $exceptionOnNonUniqueValue);
    }
}
```

### Limitations

/!\ DO NOT USE WITH `array_key_exists()` /!\

As PHP have a bug with `\ArrayAccess`, `offsetExists()` is not called by `array_key_exists()`:
```php
$intArray = new IntArray(['foo' => 18);
// will always return false, although key exist
array_key_exists('foo', $intArray);
// use isset() instead, who call \ArrayAccess::offsetExists() properly
isset($intArray['foo']);
```

As `\Iterator` PHP interface need `next()` method, and we have to use `next()` PHP function here, who return `false` : `BoolArray` could not exists.

PHP array functions who use internal pointer could not be used with AbstractTypedArray : `key()`, `prev()`, `current()`, `next()` and `end()`,
because PHP do not provide a callback when this functions are called.

Some PHP functions will not work, cause they only allow `array` (should be `iterable`) : `array_merge()` for example. Use `TypedArray::merge()` instead.
