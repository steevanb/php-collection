<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\stdClass> */
class StdClassCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \stdClass::class;
    }
}
