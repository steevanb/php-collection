<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionEnum<\UnitEnum>> */
class ReflectionEnumCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionEnum::class;
    }
}
