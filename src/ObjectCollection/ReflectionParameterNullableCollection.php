<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectNullableCollection<\ReflectionParameter|null> */
class ReflectionParameterNullableCollection extends AbstractObjectNullableCollection
{
    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \ReflectionParameter::class;
    }
}
