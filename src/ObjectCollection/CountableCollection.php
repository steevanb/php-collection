<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\Countable> */
class CountableCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \Countable::class;
    }
}
