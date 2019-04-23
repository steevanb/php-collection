<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\AbstractTypedArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\Exception\NullValueException;

final class NullValueTest extends TestCase
{
    public function testNullValueAllow(): void
    {
        $array = new TypedArray([1, 2, null]);

        static::assertCount(3, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        static::assertSame(null, $array[2]);
    }

    public function testNullValueDoNotAdd(): void
    {
        $array = (new TypedArray())
            ->setNullValueMode(TypedArray::NULL_VALUE_DO_NOT_ADD)
            ->setValues([1, 2, null]);

        static::assertCount(2, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
    }

    public function testNullValueException(): void
    {
        static::expectException(NullValueException::class);

        (new TypedArray())
            ->setNullValueMode(TypedArray::NULL_VALUE_EXCEPTION)
            ->setValues([1, 2, null]);
    }
}
