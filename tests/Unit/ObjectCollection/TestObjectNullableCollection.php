<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectNullableCollection;

/** @extends AbstractObjectNullableCollection<TestObject|null> */
class TestObjectNullableCollection extends AbstractObjectNullableCollection
{
    public static function getValueFqcn(): string
    {
        return TestObject::class;
    }
}
