[![version](https://img.shields.io/badge/version-3.1.0-green.svg)](https://github.com/steevanb/php-typed-array/tree/3.1.0)
[![php](https://img.shields.io/badge/php-^7.1||^8.0-blue.svg)](https://php.net)
![Lines](https://img.shields.io/badge/code%20lines-3835-green.svg)
![Total Downloads](https://poser.pugx.org/steevanb/php-typed-array/downloads)
[![Scrutinizer](https://scrutinizer-ci.com/g/steevanb/php-typed-array/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/steevanb/php-typed-array/)

## php-typed-array

Bored of not knowing value type in array ? You are at the right spot !

With `php-typed-array`, you can type your array values. How ? Cause now you will use object instead of array, who can control their values.

[Changelog](changelog.md)

## Installation

```
composer require steevanb/php-typed-array ^3.1
```

## Typed array available

 * `FloatArray`: can store `float`
 * `IntArray`: can store `int`
 * `ScalarArray`: can store `string|int|float|bool`
 * `StringArray`: can store `string`
 * `ObjectArray`: can store `object`
 * `ByteStringArray`: can store `Symfony\Component\String\ByteString` (need `symfony/string` to work)
 * `CodePointStringArray`: can store `Symfony\Component\String\CodePointStringArray` (need `symfony/string` to work)
 * `UnicodeStringArray`: can store `Symfony\Component\String\UnicodeStringArray` (need `symfony/string` to work)

## Usage

/!\ See [Limitations](documentation/Limitations.md) before using it, PHP have a some limitations with objects as array /!\

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
    // do your stuff, you are SURE $int is an integer !
}
```

This will throw an `\Exception`, cause `'foo'` is not allowed:
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

// ValueAlreadyExistException will be thrown
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

/!\ Calling `setValueAlreadyExistMode()` will NOT apply new mode to data already defined. It will only be applied on new values. 

### ObjectArray

If you need to store objects in array, you can use `steevanb\PhpTypedArray\ObjectArray\ObjectArray`.

To be sure each objects are an instance of something, you can configure it in `__construct()`:

```php
$dateTimeArray = new ObjectArray([new \DateTime()], \DateTime::class);
```

Or you can extends `ObjectArray` and configure it internally:

```php
class DateTimeArray extends ObjectArray
{
    public function __construct(iterable $values = [])
    {
        parent::__construct($values, \DateTime::class);
    }
    
    /** This method is not mandatory, but you can create it to typehint $typedArray and the return */
    public function merge(self $typedArray): self
    {
        parent::doMerge($typedArray);

        return $this;
    }
    
    /**
     * This method is not mandatory, but you can create it to typehint return when you access an item
     * $data = new DateTimeArray([new \DateTime(), new \DateTime()]);
     * // Autocompletion should work with the override of current()
     * $first = $data[0];
     */
    public function current(): ?\DateTime
    {
        return parent::current();
    }
}
```

## Limitations

PHP as some issues or limitations with their own implementation of `\ArrayAccess`, `iterable` etc.

[Limitations](documentation/Limitations.md)

## Bridges

You can easily integrate `php-typed-array` in your projects with this bridges:
* [Symfony](documentation/BridgeSymfony.md)
* [phpstan](documentation/BridgePhpstan.md)
