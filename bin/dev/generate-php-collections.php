<?php

declare(strict_types=1);

use Steevanb\PhpCollection\{
    Maker\ObjectCollectionMaker,
    Maker\ObjectNullableCollectionMaker
};

$rootPath = dirname(__DIR__, 2);

require $rootPath . '/vendor/autoload.php';

$maker = new ObjectCollectionMaker();
$nullableMaker = new ObjectNullableCollectionMaker();
$collectionPath = $rootPath . '/src/ObjectCollection';
$collectionNamespace = 'Steevanb\\PhpCollection\\ObjectCollection';

$interfaces = [
    '\\' . BackedEnum::class,
    '\\' . Countable::class,
    '\\' . DateTimeInterface::class,
    '\\' . JsonSerializable::class,
    '\\' . Serializable::class,
    '\\' . Stringable::class,
    '\\' . UnitEnum::class
];

foreach ($interfaces as $interface) {
    echo 'Generate collection for ' . $interface . '.' . "\n";
    $maker->make($interface, $collectionPath, $collectionNamespace);

    echo 'Generate nullable collection for ' . $interface . '.' . "\n";
    $nullableMaker->make($interface, $collectionPath, $collectionNamespace);
}

$classes = [
    '\\' . DateInterval::class,
    '\\' . DatePeriod::class,
    '\\' . DateTime::class,
    '\\' . DateTimeImmutable::class,
    '\\' . DateTimeZone::class,
    '\\' . Reflection::class,
    '\\' . ReflectionAttribute::class,
    '\\' . ReflectionClass::class,
    '\\' . ReflectionClassConstant::class,
    '\\' . ReflectionEnum::class,
    '\\' . ReflectionEnumBackedCase::class,
    '\\' . ReflectionEnumUnitCase::class,
    '\\' . ReflectionExtension::class,
    '\\' . ReflectionFiber::class,
    '\\' . ReflectionFunction::class,
    '\\' . ReflectionFunctionAbstract::class,
    '\\' . ReflectionGenerator::class,
    '\\' . ReflectionIntersectionType::class,
    '\\' . ReflectionMethod::class,
    '\\' . ReflectionNamedType::class,
    '\\' . ReflectionObject::class,
    '\\' . ReflectionParameter::class,
    '\\' . ReflectionProperty::class,
    '\\' . ReflectionReference::class,
    '\\' . ReflectionType::class,
    '\\' . ReflectionUnionType::class,
    '\\' . SplFileInfo::class,
    '\\' . SplFileObject::class,
    '\\' . stdClass::class
];

foreach ($classes as $class) {
    echo 'Generate collection for ' . $class . '.' . "\n";
    $maker->make($class, $collectionPath, $collectionNamespace);

    echo 'Generate nullable collection for ' . $class . '.' . "\n";
    $nullableMaker->make($class, $collectionPath, $collectionNamespace);
}
