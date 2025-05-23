<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectNullableCollection<\ReflectionFiber|null> */
class ReflectionFiberNullableCollection extends AbstractObjectNullableCollection
{
    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \ReflectionFiber::class;
    }
}
