<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionReference> */
class ReflectionReferenceCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionReference::class;
    }
}
