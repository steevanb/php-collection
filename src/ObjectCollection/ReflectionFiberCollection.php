<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionFiber> */
class ReflectionFiberCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionFiber::class;
    }
}
