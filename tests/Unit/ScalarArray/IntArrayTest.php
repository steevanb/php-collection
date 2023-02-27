<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ScalarArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistsException,
    ScalarArray\IntArray,
    ValueAlreadyExistsModeEnum
};

final class IntArrayTest extends TestCase
{
    public function testAllowInt(): void
    {
        $array = new IntArray([1]);

        static::assertCount(1, $array);
        static::assertSame(1, $array[0]);
    }

    public function testInvalidTypeString(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntArray(['4']);
    }

    public function testInvalidTypeFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntArray([3.1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntArray([true]);
    }

    public function testInvalidTypeNull(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntArray([null]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new IntArray([1, 2], ValueAlreadyExistsModeEnum::ADD))
            ->merge(new IntArray([1, 2]));

        static::assertCount(4, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        static::assertSame(1, $array[2]);
        static::assertSame(2, $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new IntArray([1, 2], ValueAlreadyExistsModeEnum::DO_NOT_ADD))
            ->merge(new IntArray([2, 3]));

        static::assertCount(3, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame(3, $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        (new IntArray([1, 2], ValueAlreadyExistsModeEnum::EXCEPTION))
            ->merge(new IntArray([2, 3]));
    }
}
