<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionIntersectionType> */
class ReflectionIntersectionTypeCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionIntersectionType::class;
    }
}