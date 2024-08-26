<?php

declare(strict_types=1);

use Steevanb\PhpCollection\{
    Maker\ObjectCollectionMaker,
    Maker\ObjectNullableCollectionMaker
};

$rootPath = dirname(__DIR__, 2);

require $rootPath . '/vendor/autoload.php';

$interfaces = [
    '\\' . BackedEnum::class,
    '\\' . Countable::class,
    '\\' . DateTimeInterface::class,
    '\\' . JsonSerializable::class,
    '\\' . Serializable::class,
    '\\' . Stringable::class,
    '\\' . UnitEnum::class
];

$maker = new ObjectCollectionMaker();
$nullableMaker = new ObjectNullableCollectionMaker();

foreach ($interfaces as $interface) {
    echo 'Generate collection for ' . $interface . '.' . "\n";
    $maker->make($interface, $rootPath . '/src/ObjectCollection', 'Steevanb\\PhpCollection\\ObjectCollection');

    echo 'Generate nullable collection for ' . $interface . '.' . "\n";
    $nullableMaker->make($interface, $rootPath . '/src/ObjectCollection', 'Steevanb\\PhpCollection\\ObjectCollection');
}
