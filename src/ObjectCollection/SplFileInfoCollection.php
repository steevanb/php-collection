<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\SplFileInfo> */
class SplFileInfoCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \SplFileInfo::class;
    }
}
