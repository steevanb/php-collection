<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectNullableCollection<\ReflectionEnumUnitCase|null> */
class ReflectionEnumUnitCaseNullableCollection extends AbstractObjectNullableCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionEnumUnitCase::class;
    }
}
