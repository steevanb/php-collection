<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Unit\ScalarArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\NullValueException,
    Exception\ValueAlreadyExistException,
    ScalarArray\IntArray
};

final class IntArrayTest extends TestCase
{
    public function testCastValues(): void
    {
        $array = (new IntArray())
            ->setCastValues(true)
            ->setValues([1, 2.0, 3.1, '4', true, false, null]);

        static::assertCount(7, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        static::assertSame(3, $array[2]);
        static::assertSame(4, $array[3]);
        static::assertSame(1, $array[4]);
        static::assertSame(0, $array[5]);
        static::assertNull($array[6]);
    }

    public function testAllowInt(): void
    {
        $array = new IntArray([1]);

        static::assertCount(1, $array);
        static::assertSame(1, $array[0]);
    }

    public function testAllowNull(): void
    {
        $array = new IntArray([null]);

        static::assertCount(1, $array);
        static::assertNull($array[0]);
    }

    public function testNullValueModeDoNotAdd(): void
    {
        $array = (new IntArray())
            ->setNullValueMode(IntArray::NULL_VALUE_DO_NOT_ADD)
            ->setValues([1, null]);

        static::assertCount(1, $array);
        static::assertSame(1, $array[0]);
    }

    public function testNullValueModeException(): void
    {
        static::expectException(NullValueException::class);
        (new IntArray())
            ->setNullValueMode(IntArray::NULL_VALUE_EXCEPTION)
            ->setValues([null]);
    }

    public function testDoNotCastString(): void
    {
        static::expectException(InvalidTypeException::class);
        new IntArray(['4']);
    }

    public function testDoNotCastFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        new IntArray([3.1]);
    }

    public function testDoNotCastBool(): void
    {
        static::expectException(InvalidTypeException::class);
        new IntArray([true]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new IntArray([1, 2]))
            ->setValueAlreadyExistMode(IntArray::VALUE_ALREADY_EXIST_ADD)
            ->merge(new IntArray([1, 2]));

        static::assertCount(4, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        static::assertSame(1, $array[2]);
        static::assertSame(2, $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new IntArray([1, 2]))
            ->setValueAlreadyExistMode(IntArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->merge(new IntArray([2, 3]));

        static::assertCount(3, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame(3, $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistException::class);
        (new IntArray([1, 2]))
            ->setValueAlreadyExistMode(IntArray::VALUE_ALREADY_EXIST_EXCEPTION)
            ->merge(new IntArray([2, 3]));
    }
}
