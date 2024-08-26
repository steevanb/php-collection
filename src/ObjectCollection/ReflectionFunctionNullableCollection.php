<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectNullableCollection<\ReflectionFunction|null> */
class ReflectionFunctionNullableCollection extends AbstractObjectNullableCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionFunction::class;
    }
}
