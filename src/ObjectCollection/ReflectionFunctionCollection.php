<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionFunction> */
class ReflectionFunctionCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionFunction::class;
    }
}
