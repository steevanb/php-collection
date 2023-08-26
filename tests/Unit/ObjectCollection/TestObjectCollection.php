<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection;

/** @extends AbstractObjectCollection<TestObject> */
class TestObjectCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return TestObject::class;
    }
}
