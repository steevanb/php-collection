### 2.0.0 - In dev

- Moved `steevanb\PhpTypedArray\IntArray`, `steevanb\PhpTypedArray\IntNullableArray`, `steevanb\PhpTypedArray\StringArray` and `steevanb\PhpTypedArray\StringNullableArray` into `steevanb\PhpTypedArray\ScalarArray` namespace.
- Moved `steevanb\PhpTypedArray\ObjectArray` into `steevanb\PhpTypedArray\ObjectArray` namespace.
- Moved `steevanb\PhpTypedArray\NonUniqueValueException` into `steevanb\PhpTypedArray\Exception` namespace.
- `steevanb\PhpTypedArray\Exception\NonUniqueValueException` extends `steevanb\PhpTypedArray\Exception\PhpTypedArrayException` instead of `\Exception`.
- `steevanb\PhpTypedArray\AbstractTypedArray::castValueToString` renamed to `castValueToString`.
- Removed `steevanb\PhpTypedArray\IntNullableArray` and `steevanb\PhpTypedArray\StringNullableArray`, use `setNullValueMode()` instead.
- Replaced `AbstractTypedArray::setUniqueValues()`, `isUniqueValues()`, `setExceptionOnNonUniqueValue()` and `isExceptionOnNonUniqueValue()` by `setValueAlreadyExistMode()`.
- Renamed `AbstractTypedArray::asArray()` to `toArray()`.

### [1.1.0](../../compare/1.0.1...1.1.0) - 2018-08-05

- Add `AbstractTypedArray::merge()`.
- Add `AbstractTypedArray::setUniqueValues()` and `AbstractTypedArray::isUniqueValues()`. 
- Add `AbstractTypedArray::setExceptionOnNonUniqueValue()` and `AbstractTypedArray::isExceptionOnNonUniqueValue()`.
- Add `AbstractTypedArray::__construct()` `$uniqueValues` and `$exceptionOnNonUniqueValue` parameters.

### [1.0.1](../../compare/1.0.0...1.0.1) - 2018-08-05

- Change array type hint to iterable in `AbstractTypedArray::__construct()`.

### 1.0.0 - 2018-01-18

- Create `\IntArray`, `\IntNullableArray`, `\StringArray`, `\StringNullableArray` and `\ObjectArray`.
