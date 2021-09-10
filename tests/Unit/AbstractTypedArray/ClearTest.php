<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use PHPUnit\Framework\TestCase;

final class ClearTest extends TestCase
{
    public function testEmpty(): void
    {
        $array = new TypedArray();

        static::assertCount(0, $array);
        static::assertSame(0, $array->getNextIntKey());

        $array->clear();

        static::assertCount(0, $array);
        static::assertSame(0, $array->getNextIntKey());

        $array[] = 1;

        static::assertCount(1, $array);
        static::assertSame(1, $array->getNextIntKey());
    }

    public function testOneItem(): void
    {
        $array = new TypedArray([1]);

        static::assertCount(1, $array);
        static::assertSame(1, $array->getNextIntKey());

        $array->clear();

        static::assertCount(0, $array);
        static::assertSame(0, $array->getNextIntKey());

        $array[] = 2;

        static::assertCount(1, $array);
        static::assertSame(1, $array->getNextIntKey());
    }

    public function testThreeItem(): void
    {
        $array = new TypedArray([1, 2, 3]);

        static::assertCount(3, $array);
        static::assertSame(3, $array->getNextIntKey());

        $array->clear();

        static::assertCount(0, $array);
        static::assertSame(0, $array->getNextIntKey());

        $array[] = 4;

        static::assertCount(1, $array);
        static::assertSame(1, $array->getNextIntKey());
    }
}
