<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionExtension> */
class ReflectionExtensionCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionExtension::class;
    }
}