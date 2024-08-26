<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectNullableCollection<\SplFileObject|null> */
class SplFileObjectNullableCollection extends AbstractObjectNullableCollection
{
    public static function getValueFqcn(): string
    {
        return \SplFileObject::class;
    }
}
