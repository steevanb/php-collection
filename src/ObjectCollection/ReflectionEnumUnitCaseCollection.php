<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionEnumUnitCase> */
class ReflectionEnumUnitCaseCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionEnumUnitCase::class;
    }
}
