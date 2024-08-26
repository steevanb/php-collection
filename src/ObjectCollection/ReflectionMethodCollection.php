<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionMethod> */
class ReflectionMethodCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionMethod::class;
    }
}
