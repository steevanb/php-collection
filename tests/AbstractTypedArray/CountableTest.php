<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\AbstractTypedArray;

use PHPUnit\Framework\TestCase;

final class CountableTest extends TestCase
{
    public function testCount(): void
    {
        $array = new TypedArray([1, '2', null]);

        static::assertSame(3, $array->count());
    }
}
