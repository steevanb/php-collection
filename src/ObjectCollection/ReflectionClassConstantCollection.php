<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionClassConstant> */
class ReflectionClassConstantCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionClassConstant::class;
    }
}
