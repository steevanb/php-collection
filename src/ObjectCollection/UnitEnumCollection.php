<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\UnitEnum> */
class UnitEnumCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \UnitEnum::class;
    }
}
