<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ScalarArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistsException,
    ScalarArray\IntNullableArray,
    ValueAlreadyExistsModeEnum
};

final class IntNullableArrayTest extends TestCase
{
    public function testAllowInt(): void
    {
        $array = new IntNullableArray([1]);

        static::assertCount(1, $array);
        static::assertSame(1, $array[0]);
    }

    public function testInvalidTypeString(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntNullableArray(['4']);
    }

    public function testInvalidTypeFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntNullableArray([3.1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntNullableArray([true]);
    }

    public function testAllowNull(): void
    {
        $array = new IntNullableArray([null]);

        static::assertCount(1, $array);
        static::assertNull($array[0]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new IntNullableArray([1, 2], ValueAlreadyExistsModeEnum::ADD))
            ->merge(new IntNullableArray([1, 2]));

        static::assertCount(4, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        static::assertSame(1, $array[2]);
        static::assertSame(2, $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new IntNullableArray([1, 2], ValueAlreadyExistsModeEnum::DO_NOT_ADD))
            ->merge(new IntNullableArray([2, 3]));

        static::assertCount(3, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame(3, $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        (new IntNullableArray([1, 2], ValueAlreadyExistsModeEnum::EXCEPTION))
            ->merge(new IntNullableArray([2, 3]));
    }
}
