<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionObject> */
class ReflectionObjectCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionObject::class;
    }
}
