### master

### [6.3.0](../../compare/6.2.0...6.3.0) - 2025-05-23

- Add support for Symfony `7.1` and `7.2`
- Add support for PHP `8.4`
- Add `ObjectCollectionMaker` and `ObjectNullableCollectionMaker`
- Add collections for some PHP internal interfaces, all in namespace `Steevanb\PhpCollection\ObjectCollection`:
  - `BackedEnumCollection`
  - `BackedEnumNullableCollection`
  - `CountableCollection`
  - `CountableNullableCollection`
  - `DateTimeInterfaceCollection`
  - `DateTimeInterfaceNullableCollection`
  - `JsonSerializableCollection`
  - `JsonSerializableNullableCollection`
  - `SerializableCollection`
  - `SerializableNullableCollection`
  - `StringableCollection`
  - `StringableNullableCollection`
  - `UnitEnumCollection`
  - `UnitEnumNullableCollection`
Add collections for some PHP internal classes, all in namespace `Steevanb\PhpCollection\ObjectCollection`:
 - `DateIntervalCollection`
 - `DateIntervalNullableCollection`
 - `DatePeriodCollection`
 - `DatePeriodNullableCollection`
 - `DateTimeCollection`
 - `DateTimeNullableCollection`
 - `DateTimeImmutableCollection`
 - `DateTimeImmutableNullableCollection`
 - `DateTimeZoneCollection`
 - `DateTimeZoneNullableCollection`
 - `ReflectionCollection`
 - `ReflectionNullableCollection`
 - `ReflectionAttributeCollection`
 - `ReflectionAttributeNullableCollection`
 - `ReflectionClassCollection`
 - `ReflectionClassNullableCollection`
 - `ReflectionClassConstantCollection`
 - `ReflectionClassConstantNullableCollection`
 - `ReflectionEnumCollection`
 - `ReflectionEnumNullableCollection`
 - `ReflectionEnumBackedCaseCollection`
 - `ReflectionEnumBackedCaseNullableCollection`
 - `ReflectionEnumUnitCaseCollection`
 - `ReflectionEnumUnitCaseNullableCollection`
 - `ReflectionExtensionCollection`
 - `ReflectionExtensionNullableCollection`
 - `ReflectionFiberCollection`
 - `ReflectionFiberNullableCollection`
 - `ReflectionFunctionCollection`
 - `ReflectionFunctionNullableCollection`
 - `ReflectionFunctionAbstractCollection`
 - `ReflectionFunctionAbstractNullableCollection`
 - `ReflectionGeneratorCollection`
 - `ReflectionGeneratorNullableCollection`
 - `ReflectionIntersectionTypeCollection`
 - `ReflectionIntersectionTypeNullableCollection`
 - `ReflectionMethodCollection`
 - `ReflectionMethodNullableCollection`
 - `ReflectionNamedTypeCollection`
 - `ReflectionNamedTypeNullableCollection`
 - `ReflectionObjectCollection`
 - `ReflectionObjectNullableCollection`
 - `ReflectionParameterCollection`
 - `ReflectionParameterNullableCollection`
 - `ReflectionPropertyCollection`
 - `ReflectionPropertyNullableCollection`
 - `ReflectionReferenceCollection`
 - `ReflectionReferenceNullableCollection`
 - `ReflectionTypeCollection`
 - `ReflectionTypeNullableCollection`
 - `ReflectionUnionTypeCollection`
 - `ReflectionUnionTypeNullableCollection`
 - `SplFileInfoCollection`
 - `SplFileInfoNullableCollection`
 - `SplFileObjectCollection`
 - `SplFileObjectNullableCollection`
 - `StdClassCollection`
 - `StdClassNullableCollection`

### [6.2.0](../../compare/6.1.0...6.2.0) - 2024-07-08

- Add `AbstractCollection::getFirst()` and `AbstractCollection::getLast()`

### [6.1.0](../../compare/6.0.1...6.1.0) - 2024-05-24

- Add support for Symfony `7.0`

### [6.0.1](../../compare/6.0.0...6.0.1) - 2024-05-15

- Documentation

### [6.0.0](../../compare/5.0.1...6.0.0) - 2024-05-15

- Add support for Symfony `6.3` and `6.4`
- Add support for PHP `8.3`
- Update CI dependencies
- Add support for generics
- **[BC break]** Remove `ObjectCollectionDenormalizer::createObjectCollection()` and `add()`
- **[BC break]** Rename ObjectCollectionDenormalizer::denormalizeObject()` to `denormalizeValue()`
- **[BC break]** Remove `ScalarCollectionInterface`
- **[BC break]** Remove `ScalarCollectionDenormalizer::createScalarCollection()`
- Add `bridge/` to phpstan
- Add generics everywhere it's possible
- **[BC break]** Remove `FloatCollectionInterface` and `FloatNullableCollectionInterface`
- **[BC break]** Remove `IntegerCollectionInterface` and `IntegerNullableCollectionInterface`
- **[BC break]** Remove `StringCollectionInterface` and `StringNullableCollectionInterface`
- **[BC break]** `AbstractCollection::getStringKeys()` return `StringCollection` instead of `StringCollectionInterface`
- **[BC break]** `AbstractCollection::getIntegerKeys()` return `IntegerCollection` instead of `IntegerCollectionInterface`
- **[BC break]** Rename AbstractCollection::`doReplace()` to `replace()`
- **[BC break]** Rename AbstractCollection::`doGet()` to `get()`
- **[BC break]** Rename AbstractCollection::`doHas()` to `contains()`
- **[BC break]** Add `CollectionInterface::__construct()`
- **[BC break]** Change return type of `CollectionInterface::getIntegerKeys()` from `IntegerCollectionInterface` to `IntegerCollection`
- **[BC break]** Change return type of `CollectionInterface::getStringKeys()` from `StringCollectionInterface` to `StringCollection`
- **[BC break]** Add `CollectionInterface::get()`
- **[BC break]** Add `CollectionInterface::contains()`
- **[BC break]** Add `CollectionInterface::replace()`
- **[BC break]** Remove `AbstractEnumCollection`, use `AbstractObjectCollection` instead
- **[BC break]** Add `AbstractObjectCollection::getValueFqcn()`
- **[BC break]** Add parameter `$value` to `AbstractObjectCollection::getAssertInstanceOfError()`
- **[BC break]** Add `AbstractObjectNullableCollection::getValueFqcn()`
- **[BC break]** Add parameter `$value` to `AbstractObjectNullableCollection::getAssertInstanceOfError()`
- **[BC break]** Add parameter `$value` to `ObjectCollectionTrait::getAssertInstanceOfError()`
- **[BC break]** Remove `ObjectCollectionTrait::assertClassName()`
- `ObjectCollectionTrait::castValueToString()` can cast the value from `\BackedEnum` and `\UnitEnum`
- Because of generics, remove methods in `FloatCollection`: `__construct()`, `replace()`, `has()`, `get()`, `merge()` and `toArray()`
- Because of generics, remove methods in `FloatNullableCollection`: `__construct()`, `replace()`, `has()`, `get()`, `merge()` and `toArray()`
- Because of generics, remove methods in `IntegerCollection`: `__construct()`, `replace()`, `has()`, `get()`, `merge()` and `toArray()`
- Because of generics, remove methods in `IntegerNullableCollection`: `__construct()`, `replace()`, `has()`, `get()`, `merge()` and `toArray()`
- Because of generics, remove methods in `StringCollection`: `__construct()`, `replace()`, `has()`, `get()`, `merge()` and `toArray()`
- Because of generics, remove methods in `StringNullableCollection`: `__construct()`, `replace()`, `has()`, `get()`, `merge()` and `toArray()`
- [Edhrendal](https://github.com/Edhrendal) Add `AbstractCollection::isEmpty()`
- Remove `CollectionInterface::getIntegerKeys()` and `CollectionInterface::getStringKeys()`. It still exists in `AbstractCollection`.
- **[BC break]** Remove parameter `$readOnly` in `CollectionInterface::setReadOnly()`
- **[BC break]** Remove `ValueAlreadyExistsException`
- **[BC break]** Rename `AbstractCollection::canAddValue()` to `assertValueType()`
- **[BC break]** Remove `ValueAlreadyExistsModeEnum` and all it's usages: `AbstractCollection::__construct()`, `CollectionInterface::getValueAlreadyExistsMode()` etc
- Remove `AbstractCollection::isSameValues()`
- Remove `AbstractCollection::castValueToString()`, `AbstractObjectCollection::castValueToString()` and `AbstractObjectNullableCollection::castValueToString()`
- **[BC break]** Remove `ComparisonModeEnum` and all it's usages: `ObjectCollectionTrait::getComparisonMode()`
- Remove `ObjectCollectionTrait::isSameValues()`

### [5.0.1](../../compare/5.0.0...5.0.1) - 2023-03-14

- Fix `AbstractCollection::doAdd()` who was not calling `canAddValue()`

### [5.0.0](../../compare/4.0.0...5.0.0) - 2023-03-14

- **[BC break]** Rename repository, namespace and everything else from `TypedArray` to `Collection` 
- Define PHP `8.1` as default PHP version in Docker image `steevanb/php-typed-array:ci`
- Update Composer to `2.5.4`
- **[BC break]** Remove `AbstractTypedArray::$nullValueMode`
- Call `$this->clear()` in `AbstractTypedArray::setValues()`
- Rework `AbstractTypedArray::changeKeyCase()`
- **[BC break]** Remove `NullValueException`
- **[BC break]** Remove `NullValueModeEnum`
- Add PHPDoc everywhere to force return types in `toArray()`
- **[BC break]** Remove `AbstractScalarArray`
- Add `ScalarArrayInterface` for `ScalarArrayDenormalizer`
- **[BC break]** Remove `ScalarArray`: it was not enough typed, too much types can be added
- **[BC break]** `FloatArray`, `IntArray` and `StringArray` now accepts only the right type (null is not allowed too), values will not be casted by the TypedArray
- **[BC break]** Remove `ByteStringArray`, `CodePointStringArray` and `UnicodeStringArray`: they are specific to another library
- Add `FloatNullableArray`, `IntNullableArray`, `StringNullableArray` and `ObjectNullableArray` who allow `null` and the right type
- **[BC break]** Remove `setValueAlreadyExistMode()`, now it's a parameter in `__construct()`
- **[BC break]** Change `__construct()` parameters for all TypedArray classes
- **[BC break]** AbstractEnumArray new extends `AbstractTypedArray` and not `ObjectArray`
- **[BC break]** Rename `Steevanb\PhpTypedArray\ObjectComparisonModeEnum` to `Steevanb\PhpTypedArray\ObjectArray\ComparisonModeEnum`
- **[BC break]** Remove `ObjectArray` to force an `ObjectArray` to have instance of only one class/interface.
- **[BC break]** Default comparison mode for `ObjectArray` is `HASH` (it was `STRING`)
- **[BC break]** Rename `ValueAlreadyExistException` to `ValueAlreadyExistsException` and `AbstractTypedArray::getValueAlreadyExistMode()` to `AbstractTypedArray::getValueAlreadyExistsMode()`
- **[BC break]** Remove parameter `$offset` of `AbstractTypedArray::canAddValue()`
- **[BC break]** Rename `IntCollection` to `IntegerCollection`
- **[BC break]** Remove implementations of `\Iterator` and `\ArrayAccess`, too much bugs in PHP with this interfaces
- **[BC break]** Remove phpstan rule
- **[BC break]** `AbstractCollection::changeKeyCase()` parameter `$case` type changed from `int` to `KeyCaseEnum` 

### [4.0.0](../../compare/3.3.2...4.0.0) - 2022-12-20

- **[BC break]** Remove support for PHP 7.1, 7.2, 7.3, 7.4 and 8.0
- Add support for PHP 8.2
- **[BC break]** Remove support for Symfony < 6.1
- Add support for Symfony 6.1 and 6.2
- **[BC break]** Rename namespace first part from `steevanb` to `Steevanb`
- **[BC break]** `AbstractTypedArray::NULL_VALUE_ALLOW`, `NULL_VALUE_DO_NOT_ADD` and `NULL_VALUE_EXCEPTION` are replaced by `NullValueModeEnum`
- **[BC break]** `AbstractTypedArray::VALUE_ALREADY_EXIST_ADD`, `VALUE_ALREADY_EXIST_DO_NOT_ADD` and `VALUE_ALREADY_EXIST_EXCEPTION` are replaced by `ValueAlreadyExistsModeEnum`
- **[BC break]** `ObjectArray::COMPARISON_STRING` and `COMPARISON_OBJECT_HASH` are replaced by `ObjectComparisonModeEnum`
- **[BC break]** Add types everywhere we can
- Add `AbstractEnumArray` to store PHP 8.1 `\UnitEnum`.
- **[BC break]** `ObjectArray` could not store instances of `\UnitEnum` anymore.
- **[BC break]** Remove ReadOnlyInterface, merged into CollectionInterface

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
- **[BC break]** Removed `steevanb\PhpTypedArray\ScalarArray\BoolArray`: do not work and will never work due to `\Iterator`

### [3.0.1](../../compare/3.0.0...3.0.1) - 2021-02-18

- Fix `ObjectArrayDenormalizer::createObjectArray()`
- Fix Symfony bridge tests

### [3.0.0](../../compare/2.6.0...3.0.0) - 2021-02-18

- Add tests for [symfony/serializer](https://github.com/symfony/serializer) `4.4`, `5.0`, `5.1` and `5.2`
- **[BC break]** Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\AbstractObjectArrayDenormalizer`
- **[BC break]** Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\ByteStringArrayDenormalizer`
- **[BC break]** Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\CodePointStringArrayDenormalizer`
- **[BC break]** Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\UnicodeStringArrayDenormalizer`
- Moved `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\ObjectArrayDenormalizer` to `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArrayDenormalizer`
- **[BC break]** Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\AbstractScalarArrayDenormalizer`
- **[BC break]** Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\BoolArrayDenormalizer`
- **[BC break]** Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\FloatArrayDenormalizer`
- **[BC break]** Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\IntArrayDenormalizer`
- **[BC break]** Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\ScalarArrayDenormalizer`
- **[BC break]** Removed `steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\StringArrayDenormalizer`
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
