<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\Serializable> */
class SerializableCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \Serializable::class;
    }
}
