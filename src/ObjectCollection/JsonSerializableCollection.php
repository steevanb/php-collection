<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\JsonSerializable> */
class JsonSerializableCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \JsonSerializable::class;
    }
}
