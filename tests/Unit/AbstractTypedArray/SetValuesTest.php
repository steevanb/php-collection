<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use PHPUnit\Framework\TestCase;

final class SetValuesTest extends TestCase
{
    public function testConstructorValues(): void
    {
        $array = new TypedArray([10, 11, 12, 13]);

        static::assertCount(4, $array);
        static::assertSame(10, $array[0]);
        static::assertSame(11, $array[1]);
        static::assertSame(12, $array[2]);
        static::assertSame(13, $array[3]);
    }

    public function testSetValues(): void
    {
        $array = (new TypedArray())
            ->setValues([10, 11, 12, 13]);

        static::assertCount(4, $array);
        static::assertSame(10, $array[0]);
        static::assertSame(11, $array[1]);
        static::assertSame(12, $array[2]);
        static::assertSame(13, $array[3]);
    }
}
