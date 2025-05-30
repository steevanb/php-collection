<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionClassConstant> */
class ReflectionClassConstantCollection extends AbstractObjectCollection
{
    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \ReflectionClassConstant::class;
    }
}
