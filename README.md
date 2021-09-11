[![Version](https://img.shields.io/badge/version-3.2.0-blueviolet.svg)](https://github.com/steevanb/php-typed-array/tree/3.2.0)
[![PHP](https://img.shields.io/badge/php-^7.1||^8.0-blue.svg)](https://php.net)
![Lines](https://img.shields.io/badge/code%20lines-4,630-blue.svg)
![Downloads](https://poser.pugx.org/steevanb/php-typed-array/downloads)
![GitHub workflow status](https://img.shields.io/github/workflow/status/steevanb/php-typed-array/CI)
![Coverage](https://img.shields.io/badge/coverage-96%25-success.svg)

## php-typed-array

Bored of not knowing value type in array ? You are at the right spot !

With `php-typed-array`, you can type your array values. How ? Cause now you will use object instead of array, who can control their values.

[Changelog](changelog.md)

## Installation

```
composer require steevanb/php-typed-array ^3.2
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
// IntArray will contain [1, 2, 2]
(new IntArray())
    // Default behavior, code here is just for the example
    ->setValueAlreadyExistMode(IntArray::VALUE_ALREADY_EXIST_ADD)
    ->setValues([1, 2, 2]);

// IntArray will contain [1, 2]
(new IntArray())
    ->setValueAlreadyExistMode(IntArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
    ->setValues([1, 2, 2]);

// ValueAlreadyExistException will be throwned
(new IntArray())
    ->setValueAlreadyExistMode(IntArray::VALUE_ALREADY_EXIST_EXCEPTION)
    ->setValues([1, 2, 2]);
```

/!\ Calling `setValueAlreadyExistMode()` will NOT apply new mode to data already defined. It will only be applied on new values. 

### Behavior when adding null

You can configure the behavior when `null` value is added:

```php
// IntArray will contain [1, 2, null]
(new IntArray())
    // default behavior, code here is just for the example
    ->setValueAlreadyExistMode(IntArray::NULL_VALUE_ALLOW)
    ->setValues([1, 2, null]);

// IntArray will contain [1, 2]
(new IntArray())
    ->setValueAlreadyExistMode(IntArray::NULL_VALUE_DO_NOT_ADD)
    ->setValues([1, 2, null]);

// NullValueException will be throwned
(new IntArray())
    ->setValueAlreadyExistMode(IntArray::NULL_VALUE_EXCEPTION)
    ->setValues([1, 2, null]);
```

### Read only

Sometimes when you add values in your TypedArray, once you have finished you don't want this object to be modified.

You can have this behavior with read only:

```php
$foo = new IntArray([1, 2]);
// By default you can add values after object creation
$foo[] = 3;
// Now set read only
$foo->setReadOnly(); // you don't need to define first parameter to true: it's default value
// ReadOnlyException will be throwned
$foo[] = 4;

// You can disable readonly
$foo->setReadOnly(false);
$foo[] = 3;
```

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

## Methods to modify keys and values

All methods below will directly apply modifications, 
it will not return a new TypedArray with modifications applied like some PHP functions do.

| Method | Version | PHP associated function | Description |
| --- | --- | --- | --- |
| `clear()` | ^3.3 | _none_ | Clear all data and reset next key to `0`. Next data added with `$array[]` will have key `0`. |
| `changeKeyCase()` | ^3.3 | [array_change_key_case()](https://www.php.net/manual/fr/function.array-change-key-case.php) | Changes the case of all keys |

## Limitations

PHP as some issues or limitations with their own implementation of `\ArrayAccess`, `iterable` etc.

[Limitations](documentation/Limitations.md)

## Bridges

You can easily integrate `php-typed-array` in your projects with this bridges:
* [Symfony](documentation/BridgeSymfony.md)
* [phpstan](documentation/BridgePhpstan.md)
