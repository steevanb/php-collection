<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\BackedEnum> */
class BackedEnumCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \BackedEnum::class;
    }
}