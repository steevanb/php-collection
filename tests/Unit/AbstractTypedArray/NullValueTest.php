<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\NullValueException,
    NullValueModeEnum
};

final class NullValueTest extends TestCase
{
    public function testNullValueAllow(): void
    {
        $array = new TypedArray([1, 2, null]);

        static::assertCount(3, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        static::assertNull($array[2]);
    }

    public function testNullValueDoNotAdd(): void
    {
        $array = (new TypedArray())
            ->setNullValueMode(NullValueModeEnum::DO_NOT_ADD)
            ->setValues([1, 2, null]);

        static::assertCount(2, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
    }

    public function testNullValueException(): void
    {
        static::expectException(NullValueException::class);

        (new TypedArray())
            ->setNullValueMode(NullValueModeEnum::EXCEPTION)
            ->setValues([1, 2, null]);
    }
}
