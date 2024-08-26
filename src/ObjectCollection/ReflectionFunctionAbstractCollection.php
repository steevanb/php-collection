<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionFunctionAbstract> */
class ReflectionFunctionAbstractCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionFunctionAbstract::class;
    }
}
