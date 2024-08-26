<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionNamedType> */
class ReflectionNamedTypeCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionNamedType::class;
    }
}
