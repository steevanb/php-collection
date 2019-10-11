### [2.1.0](../../compare/2.0.1...2.1.0) - 2019-10-11

- [[BaBeuloula](https://github.com/babeuloula)] Add `steevanb\PhpTypedArray\ObjectArray\ByteStringArray`
- [[BaBeuloula](https://github.com/babeuloula)] Add `steevanb\PhpTypedArray\ObjectArray\CodePointStringArray`
- [[BaBeuloula](https://github.com/babeuloula)] Add `steevanb\PhpTypedArray\ObjectArray\UnicodeStringArray`
- Add composerRequireChecker
- Add phpcf
- Update phpcs to 2.0.10
- Add phpstan

### [2.0.1](../../compare/2.0.0...2.0.1) - 2019-05-10

- Add `/** @return $this */` when a method return self for PHPStorm autocompletion.

### [2.0.0](../../compare/1.1.0...2.0.0) - 2019-04-27

- Moved `steevanb\PhpTypedArray\IntArray`, `steevanb\PhpTypedArray\IntNullableArray`, `steevanb\PhpTypedArray\StringArray` and `steevanb\PhpTypedArray\StringNullableArray` into `steevanb\PhpTypedArray\ScalarArray` namespace.
- Moved `steevanb\PhpTypedArray\ObjectArray` into `steevanb\PhpTypedArray\ObjectArray` namespace.
- Moved `steevanb\PhpTypedArray\NonUniqueValueException` into `steevanb\PhpTypedArray\Exception` namespace.
- `steevanb\PhpTypedArray\Exception\NonUniqueValueException` extends `steevanb\PhpTypedArray\Exception\PhpTypedArrayException` instead of `\Exception`.
- `steevanb\PhpTypedArray\AbstractTypedArray::castValueToString` renamed to `castValueToString`.
- Removed `steevanb\PhpTypedArray\IntNullableArray` and `steevanb\PhpTypedArray\StringNullableArray`, use `setNullValueMode()` instead.
- Replaced `AbstractTypedArray::setUniqueValues()`, `isUniqueValues()`, `setExceptionOnNonUniqueValue()` and `isExceptionOnNonUniqueValue()` by `setValueAlreadyExistMode()`.
- Renamed `AbstractTypedArray::asArray()` to `toArray()`.
- All throwned exceptions are instance of `steevanb\PhpTypedArray\PhpTypedArrayException` instead of `\Exception`.
- Create `steevanb\PhpTypedArray\InvalidTypeException` throwned instead of `\Exception` when trying to add a value into a AbstractTypedArray.
- Renamed `steevanb\PhpTypedArray\NonUniqueValueException` to `steevanb\PhpTypedArray\ValueAlreadyExistException`.
- Removed `steevanb\PhpTypedArray\AbstractTypedArray::merge()`, too much differences with PHP `array_merge()` function and it could be called directly: `array_merge($typedArray1->toArray(), $typedArray2->toArray())`.

### [1.1.0](../../compare/1.0.1...1.1.0) - 2018-08-05

- Add `AbstractTypedArray::merge()`.
- Add `AbstractTypedArray::setUniqueValues()` and `AbstractTypedArray::isUniqueValues()`. 
- Add `AbstractTypedArray::setExceptionOnNonUniqueValue()` and `AbstractTypedArray::isExceptionOnNonUniqueValue()`.
- Add `AbstractTypedArray::__construct()` `$uniqueValues` and `$exceptionOnNonUniqueValue` parameters.

### [1.0.1](../../compare/1.0.0...1.0.1) - 2018-08-05

- Change array type hint to iterable in `AbstractTypedArray::__construct()`.

### 1.0.0 - 2018-01-18

- Create `\IntArray`, `\IntNullableArray`, `\StringArray`, `\StringNullableArray` and `\ObjectArray`.
