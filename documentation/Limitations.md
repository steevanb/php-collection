## array_key_exists()

/!\ DO NOT USE WITH `array_key_exists()` /!\

As PHP have a bug with `\ArrayAccess`, `offsetExists()` is not called by `array_key_exists()`:
```php
$intArray = new IntArray(['foo' => 18);
// will always return false, although key exist
array_key_exists('foo', $intArray);
// use isset() instead, who call \ArrayAccess::offsetExists() properly
isset($intArray['foo']);
```

## BoolArray

As `\Iterator` PHP interface need `next()` method, and we have to use `next()` PHP function here, who return `false`: `BoolArray` could not exists.

## key(), prev(), current(), next() and end()

PHP array functions who use internal pointer could not be used with AbstractTypedArray: `key()`, `prev()`, `current()`, `next()` and `end()`,
because PHP do not provide a callback when this functions are called.

## Other php functions

Some PHP functions will not work, cause they only allow `array` (it should be `iterable`).
You can use `$typedArray->toArray()` to use them.

## foreach

`foreach` is not compatible with `\ArrayAccess` when you iterate over same object inside another `foreach`.

Internal pointer of `\ArrayAccess` is modified by the seconde level of foreach and first level is impacted but should not:

```php
$array = new IntArray([1, 2]);
foreach ($array as $int1) {
    echo 'FIRST ' . $int1 . "\n";
    foreach ($array as $int2) {
        echo 'SECOND ' . $int2 . "\n";
    }
}

// Output:
// FIRST 1
// SECOND 1
// SECOND 2

// Expected:
// FIRST 1
// SECOND 1
// SECOND 2
// FIRST 2
// SECOND 1
// SECOND 2
```

To fix it you can use TypedArrayInterface::toArray():
```php
$array = new IntArray([1, 2]);
foreach ($array->toArray() as $int1) {
    echo 'FIRST ' . $int1 . "\n";
    foreach ($array->toArray() as $int2) {
        echo 'SECOND ' . $int2 . "\n";
    }
}

// Output:
// FIRST 1
// SECOND 1
// SECOND 2
// FIRST 2
// SECOND 1
// SECOND 2
```

You can install PhpStan bridge to disallow `foreach` without `toArray()`.
