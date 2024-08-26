<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionEnumBackedCase> */
class ReflectionEnumBackedCaseCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionEnumBackedCase::class;
    }
}
