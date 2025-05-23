<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectNullableCollection<\ReflectionUnionType|null> */
class ReflectionUnionTypeNullableCollection extends AbstractObjectNullableCollection
{
    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \ReflectionUnionType::class;
    }
}
