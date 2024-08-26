<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\Reflection> */
class ReflectionCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \Reflection::class;
    }
}
