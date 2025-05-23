<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionClass<object>> */
class ReflectionClassCollection extends AbstractObjectCollection
{
    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \ReflectionClass::class;
    }
}
