<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\SplFileObject> */
class SplFileObjectCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \SplFileObject::class;
    }
}
