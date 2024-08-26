<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionType> */
class ReflectionTypeCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionType::class;
    }
}
