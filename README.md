[![Version](https://img.shields.io/badge/version-4.0.0-blueviolet.svg)](https://github.com/steevanb/php-collection/tree/4.0.0)
[![PHP](https://img.shields.io/badge/php-^8.1-blue.svg)](https://php.net)
![Lines](https://img.shields.io/badge/code%20lines-4,637-blue.svg)
![Downloads](https://poser.pugx.org/steevanb/php-collection/downloads)
![GitHub workflow status](https://img.shields.io/github/actions/workflow/status/steevanb/php-collection/ci.yml?branch=master)
![Coverage](https://img.shields.io/badge/coverage-96%25-success.svg)

## php-collection

Bored of not knowing value type in array? You are at the right spot!

With `php-collection`, you can type your array values. How? Cause now you will use object instead of array, who can control their values.

[Changelog](changelog.md)

## Installation

```
composer require steevanb/php-collection ^4.0
```

## Typed array available

 * `FloatArray`: can store `float`
 * `FloatNullableArray`: can store `float` or `null`
 * `IntArray`: can store `int`
 * `IntNullableArray`: can store `int` or `null`
 * `StringArray`: can store `string`
 * `StringNullableArray`: can store `string` or `null`
 * `AbstractObjectArray`: can store `object`
 * `AbstractObjectNullableArray`: can store `object` or `null`
 * `AbstractEnumArray`: can store instances of `\UnitEnum` (PHP 8.1 enums)

## Usage

Simple usage:
```php
$intArray = new IntArray([1, 2]);
$intArray['key'] = 3;
foreach ($intArray as $key => $int) {
    // do your stuff, you are SURE $int is integer!
}
```

Usefull usage:
```php
function returnInts(): IntArray
{
    return new IntArray([1, 2, 3]); 
}

foreach (returnInts() as $key => $int) {
    // do your stuff, you are SURE $int is an integer!
}
```

This will throw an `\Exception`, cause `'foo'` is not allowed:
```php
$intArray = new IntArray([1, 2, 'foo']);
```

### Filter values to be uniques

If you want to be sure a value is unique inside your Collection, you have to configure `valueAlreadyExistMode`:

```php
// Default behavior, code here is just for the example
// IntArray will contain [1, 2, 2]
new IntArray([1, 2, 2], ValueAlreadyExistsModeEnum::ADD);

// IntArray will contain [1, 2]
new IntArray([1, 2, 2], ValueAlreadyExistsModeEnum::DO_NOT_ADD);

// ValueAlreadyExistSException will be throwned
(new IntArray([1, 2, 2], ValueAlreadyExistsModeEnum::EXCEPTION));
```

### Read only

Sometimes when you add values in your Collection, once you have finished you don't want this object to be modified.

You can have this behavior with read only:

```php
$foo = new IntArray([1, 2]);
// By default, you can add values after object creation
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

If you need to store objects in array, you have to create a classe who extends
`Steevanb\PhpCollection\ObjectArray\AbstractObjectArray` or `AbstractObjectNullableArray`.

```php
class DateTimeArray extends AbstractObjectArray
{
    public function __construct(iterable $values = [])
    {
        parent::__construct(\DateTime::class, $values);
    }
    
    /** This method is not mandatory, but you can create it to type $values */
    public function merge(self $values): static
    {
        parent::doMerge($values);

        return $this;
    }
    
    /**
     * This method is not mandatory, but you can create it to type return when you access an item
     * $data = new DateTimeArray([new \DateTime(), new \DateTime()]);
     * // Autocompletion should work with the override of current()
     * $first = $data[0];
     */
    public function current(): ?\DateTime
    {
        return parent::current();
    }
    
    /** This method is not mandatory, but you can create it to type the return */
    /** @return array<\DateTime> */
    public function toArray(): array
    {
        return parent::toArray();
    }
}
```

### EnumArray

If you need to store enums in array, 
you can create a class who extends `Steevanb\PhpCollection\EnumArray\AbstractEnumArray`.

```php
class FooEnumArray extends AbstractEnumArray
{
    public function __construct(iterable $values = [])
    {
        parent::__construct(FooEnum::clas, $values);
    }
    
    /** This method is not mandatory, but you can create it to type $values */
    public function merge(self $values): static
    {
        parent::doMerge($values);

        return $this;
    }
    
    /**
     * This method is not mandatory, but you can create it to type return when you access an item
     * $data = new FooEnumArray([FooEnum::VALUE1, FooEnum::VALUE2]);
     * // Autocompletion should work with the override of current()
     * $first = $data[0];
     */
    public function current(): ?FooEnum
    {
        return parent::current();
    }
    
    /** This method is not mandatory, but you can create it to type the return */
    /** @return array<FooEnum> */
    public function toArray(): array
    {
        return parent::toArray();
    }
}
```

## Methods to modify keys and values

All methods below will directly apply modifications, 
it will not return a new Collection with modifications applied like some PHP functions do.

| Method | PHP associated function | Description |
| --- | --- | --- |
| `clear()` | _none_ | Clear all data and reset next key to `0`. Next data added with `$array[]` will have key `0`. |
| `changeKeyCase()` | [array_change_key_case()](https://www.php.net/manual/fr/function.array-change-key-case.php) | Changes the case of all keys |

## Bridges

You can easily integrate `php-collection` in your projects with these bridges:
* [Symfony](documentation/BridgeSymfony.md)
