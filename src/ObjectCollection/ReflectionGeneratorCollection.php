<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\ReflectionGenerator> */
class ReflectionGeneratorCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \ReflectionGenerator::class;
    }
}
