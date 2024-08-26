<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionAttribute<object>> */
class ReflectionAttributeCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionAttribute::class;
    }
}
