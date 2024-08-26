<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionUnionType> */
class ReflectionUnionTypeCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionUnionType::class;
    }
}
