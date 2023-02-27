<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ScalarArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistException,
    ScalarArray\FloatNullableArray,
    ValueAlreadyExistsModeEnum
};

final class FloatNullableArrayTest extends TestCase
{
    public function testAllowFloat(): void
    {
        $array = new FloatNullableArray([1.0]);

        static::assertCount(1, $array);
        static::assertSame(1.0, $array[0]);
    }

    public function testInvalidTypeString(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new FloatNullableArray(['4']);
    }

    public function testInvalidTypeInt(): void
    {
        static::expectException(InvalidTypeException::class);
        new FloatNullableArray([1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new FloatNullableArray([true]);
    }

    public function testAllowNull(): void
    {
        $array = new FloatNullableArray([null]);

        static::assertCount(1, $array);
        static::assertNull($array[0]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new FloatNullableArray([1.0, 2.0], ValueAlreadyExistsModeEnum::ADD))
            ->merge(new FloatNullableArray([1.0, 2.0]));

        static::assertCount(4, $array);
        static::assertSame(1.0, $array[0]);
        static::assertSame(2.0, $array[1]);
        static::assertSame(1.0, $array[2]);
        static::assertSame(2.0, $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new FloatNullableArray([1.0, 2.0], ValueAlreadyExistsModeEnum::DO_NOT_ADD))
            ->merge(new FloatNullableArray([2.0, 3.0]));

        static::assertCount(3, $array);
        static::assertSame(1.0, $array[0]);
        static::assertSame(2.0, $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame(3.0, $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistException::class);
        (new FloatNullableArray([1.0, 2.0], ValueAlreadyExistsModeEnum::EXCEPTION))
            ->merge(new FloatNullableArray([2.0, 3.0]));
    }
}
