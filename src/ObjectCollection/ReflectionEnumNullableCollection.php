<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectNullableCollection<\ReflectionEnum|null> */
class ReflectionEnumNullableCollection extends AbstractObjectNullableCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionEnum::class;
    }
}
