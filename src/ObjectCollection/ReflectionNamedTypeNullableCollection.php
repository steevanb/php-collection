<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectNullableCollection<\ReflectionNamedType|null> */
class ReflectionNamedTypeNullableCollection extends AbstractObjectNullableCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionNamedType::class;
    }
}
