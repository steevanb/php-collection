<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\SplFileObject> */
class SplFileObjectCollection extends AbstractObjectCollection
{
    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \SplFileObject::class;
    }
}
