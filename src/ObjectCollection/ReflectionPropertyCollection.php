<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionProperty> */
class ReflectionPropertyCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionProperty::class;
    }
}
