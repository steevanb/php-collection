<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionParameter> */
class ReflectionParameterCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionParameter::class;
    }
}
