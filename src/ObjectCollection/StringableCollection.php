<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\Stringable> */
class StringableCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \Stringable::class;
    }
}
