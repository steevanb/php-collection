### master

- [BC Break] Rename repository, namespace and everything else from `TypedArray` to `Collection` 
- Define PHP `8.1` as default PHP version in Docker image `steevanb/php-typed-array:ci`
- Update Composer to `2.5.4`
- [BC Break] Remove `AbstractTypedArray::$nullValueMode`
- Call `$this->clear()` in `AbstractTypedArray::setValues()`
- Rework `AbstractTypedArray::changeKeyCase()`
- [BC Break] Remove `NullValueException`
- [BC Break] Remove `NullValueModeEnum`
- Add PHPDoc everywhere to force return types in `toArray()`
- [BC Break] Remove `AbstractScalarArray`
- Add `ScalarArrayInterface` for `ScalarArrayDenormalizer`
- [BC Break] Remove `ScalarArray`: it was not enough typed, too much types can be added
- [BC Break] `FloatArray`, `IntArray` and `StringArray` now accepts only the right type (null is not allowed too), values will not be casted by the TypedArray
- [BC Break] Remove `ByteStringArray`, `CodePointStringArray` and `UnicodeStringArray`: they are specific to another library
- Add `FloatNullableArray`, `IntNullableArray`, `StringNullableArray` and `ObjectNullableArray` who allow `null` and the right type
- [BC Break] Remove `setValueAlreadyExistMode()`, now it's a parameter in `__construct()`
- [BC Break] Change `__construct()` parameters for all TypedArray classes
- [BC Break] AbstractEnumArray new extends `AbstractTypedArray` and not `ObjectArray`
- [BC Break] Rename `Steevanb\PhpTypedArray\ObjectComparisonModeEnum` to `Steevanb\PhpTypedArray\ObjectArray\ComparisonModeEnum`
- [BC Break] Remove `ObjectArray` to force an `ObjectArray` to have instance of only one class/interface.
- [BC Break] Default comparison mode for `ObjectArray` is `HASH` (it was `STRING`)
- [BC Break] Rename `ValueAlreadyExistException` to `ValueAlreadyExistsException` and `AbstractTypedArray::getValueAlreadyExistMode()` to `AbstractTypedArray::getValueAlreadyExistsMode()`
- [BC Break] Remove parameter `$offset` of `AbstractTypedArray::canAddValue()`
- [BC Break] Rename `IntCollection` to `IntegerCollection`
- [BC Break] Remove implementations of `\Iterator` and `\ArrayAccess`, too much bugs in PHP with this interfaces
- [BC Break] Remove phpstan rule
- [BC Break] `AbstractCollection::changeKeyCase()` parameter `$case` type changed from `int` to `KeyCaseEnum` 

### [4.0.0](../../compare/3.3.2...4.0.0) - 2022-12-20

- [BC Break] Remove support for PHP 7.1, 7.2, 7.3, 7.4 and 8.0
- Add support for PHP 8.2
- [BC Break] Remove support for Symfony < 6.1
- Add support for Symfony 6.1 and 6.2
- [BC Break] Rename namespace first part from `steevanb` to `Steevanb`
- [BC Break] `AbstractTypedArray::NULL_VALUE_ALLOW`, `NULL_VALUE_DO_NOT_ADD` and `NULL_VALUE_EXCEPTION` are replaced by `NullValueModeEnum`
- [BC Break] `AbstractTypedArray::VALUE_ALREADY_EXIST_ADD`, `VALUE_ALREADY_EXIST_DO_NOT_ADD` and `VALUE_ALREADY_EXIST_EXCEPTION` are replaced by `ValueAlreadyExistsModeEnum`
- [BC Break] `ObjectArray::COMPARISON_STRING` and `COMPARISON_OBJECT_HASH` are replaced by `ObjectComparisonModeEnum`
- [BC Break] Add types everywhere we can
- Add `AbstractEnumArray` to store PHP 8.1 `\UnitEnum`.
- [BC Break] `ObjectArray` could not store instances of `\UnitEnum` anymore.
- [BC Break] Remove ReadOnlyInterface, merged into CollectionInterface

### [3.3.2](../../compare/3.3.1...3.3.2) - 2021-12-23

- Add #[\ReturnTypeWillChange] when needed to remove a new deprecated with PHP 8.1

### [3.3.1](../../compare/3.3.0...3.3.1) - 2021-09-11

- Fix `composer require` version in `README.md` in GitHub Actions workflow `Release`

### [3.3.0](../../compare/3.2.0...3.3.0) - 2021-09-11

- Add `AbstractTypedArray::reset()`
- Add `AbstractTypedArray::changeKeyCase()`
- CI moved from CircleCI to GitHub Actions
- Add tools in `bin/ci`: `composer-validate`, `phpunit-coverage`, `shellcheck` and `unused-scanner`
- Rework `bin/ci` binaries
- Add `bin/release` binaries
- Add GitHub Actions workflow `Release`

### [3.2.0](../../compare/3.1.1...3.2.0) - 2021-05-13

- Add `ReadOnlyInterface`
- Add `AbstractTypedArray::setReadOnly()` and `AbstractTypedArray::isReadOnly()`

### [3.1.1](../../compare/3.1.0...3.1.1) - 2021-05-10

- Fix `.gitattributes`

### [3.1.0](../../compare/3.0.1...3.1.0) - 2021-05-10

- Allow PHP `^8.0` (it was already compatible)
- [BC Break] Removed `steevanb\PhpTypedArray\ScalarArray\BoolArray`: do not work and will never work due to `\Iterator`

### [3.0.1](../../compare/3.0.0...3.0.1) - 2021-02-18

- Fix `ObjectArrayDenormalizer::createObjectArray()`
- Fix Symfony bridge tests

### [3.0.0](../../compare/2.6.0...3.0.0) - 2021-02-18

- Add tests for [symfony/serializer](https://github.com/symfony/serializer) `4.4`, `5.0`, `5.1` and `5.2`
- [BC break] Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\AbstractObjectArrayDenormalizer`
- [BC break] Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\ByteStringArrayDenormalizer`
- [BC break] Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\CodePointStringArrayDenormalizer`
- [BC break] Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\UnicodeStringArrayDenormalizer`
- Moved `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\ObjectArrayDenormalizer` to `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArrayDenormalizer`
- [BC break] Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\AbstractScalarArrayDenormalizer`
- [BC break] Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\BoolArrayDenormalizer`
- [BC break] Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\FloatArrayDenormalizer`
- [BC break] Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\IntArrayDenormalizer`
- [BC break] Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\ScalarArrayDenormalizer`
- [BC break] Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\StringArrayDenormalizer`
- Add `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArrayDenormalizer` to replace `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\*Denormalizer`
- Create Docker image `steevanb/php-typed-array-ci:1.0.0` who contains [symfony/serializer](https://github.com/symfony/serializer) versions and [phpstan](https://github.com/phpstan/phpstan)

### [2.6.0](../../compare/2.5.0...2.6.0) - 2021-02-03

- Add `ObjectArrayDenormalizer` to denormalize all instances of `ObjectArray`
- Deprecate `ByteStringArrayDenormalizer`, `CodePointStringArrayDenormalizer` and `UnicodeStringArrayDenormalizer` (replaced by `ObjectArrayDenormalizer`)
- Launch unit tests with PHP 7.1, 7.2, 7.3 and 7.4 (only 7.4 before)
- Fix `AbstractTypedArray` return types for PHP 7.1, 7.2 and 7.3

### [2.5.0](../../compare/2.4.0...2.5.0) - 2020-12-30

- Add `TypedArrayInterface` and use it in `AbstractTypedArray`
- Add `DisallowTypedArrayRule` for phpstan

### [2.4.0](../../compare/2.3.0...2.4.0) - 2020-12-03

- Add Symdony bridge
- Add Denormalizer for [symfony/serializer](https://github.com/symfony/serializer) component

### [2.3.0](../../compare/2.2.0...2.3.0) - 2020-11-10

- Add `steevanb\PhpTypedArray\ScalarArray\BoolArray`
- Add `steevanb\PhpTypedArray\ScalarArray\FloatArray`
- Add `steevanb\PhpTypedArray\ScalarArray\ScalarArray`
- Add some unit tests

### [2.2.0](../../compare/2.1.1...2.1.2) - 2020-10-29

- Add merge() function to all but ObjectArray
- Update CI

### [2.1.2](../../compare/2.1.1...2.1.2) - 2019-10-11

- Documentation

### [2.1.1](../../compare/2.1.0...2.1.1) - 2019-10-11

- Documentation

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
