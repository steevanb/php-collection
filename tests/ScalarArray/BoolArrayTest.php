<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ScalarArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\NullValueException,
    Exception\ValueAlreadyExistException,
    ScalarArray\BoolArray
};

final class BoolArrayTest extends TestCase
{
    public function testCastValues(): void
    {
        $array = (new BoolArray())
            ->setCastValues(true)
            ->setValues([1, 2.0, 3.1, '4', true, false, null]);

        static::assertCount(7, $array);
        static::assertSame(true, $array[0]);
        static::assertSame(true, $array[1]);
        static::assertSame(true, $array[2]);
        static::assertSame(true, $array[3]);
        static::assertSame(true, $array[4]);
        static::assertSame(false, $array[5]);
        static::assertSame(null, $array[6]);
    }

    public function testAllowBool(): void
    {
        $array = (new BoolArray([true, false]));

        static::assertCount(2, $array);
        static::assertSame(true, $array[0]);
        static::assertSame(false, $array[1]);
    }

    public function testAllowNull(): void
    {
        $array = new BoolArray([null]);

        static::assertCount(1, $array);
        static::assertSame(null, $array[0]);
    }

    public function testNullValueModeDoNotAdd(): void
    {
        $array = (new BoolArray())
            ->setNullValueMode(BoolArray::NULL_VALUE_DO_NOT_ADD)
            ->setValues([true, false, null]);

        static::assertCount(2, $array);
        static::assertSame(true, $array[0]);
        static::assertSame(false, $array[1]);
    }

    public function testNullValueModeException(): void
    {
        static::expectException(NullValueException::class);
        (new BoolArray())
            ->setNullValueMode(BoolArray::NULL_VALUE_EXCEPTION)
            ->setValues([null]);
    }

    public function testDoNotCastString(): void
    {
        static::expectException(InvalidTypeException::class);
        new BoolArray(['4']);
    }

    public function testDoNotCastFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        new BoolArray([3.1]);
    }

    public function testDoNotCastInt(): void
    {
        static::expectException(InvalidTypeException::class);
        new BoolArray([1]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new BoolArray([true, false]))
            ->setValueAlreadyExistMode(BoolArray::VALUE_ALREADY_EXIST_ADD)
            ->merge(new BoolArray([true, false]));

        static::assertCount(4, $array);
        static::assertSame(true, $array[0]);
        static::assertSame(false, $array[1]);
        static::assertSame(true, $array[2]);
        static::assertSame(false, $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new BoolArray([true]))
            ->setValueAlreadyExistMode(BoolArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->merge(new BoolArray([true, false]));

        static::assertCount(2, $array);
        static::assertSame(true, $array[0]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame(false, $array[2]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistException::class);
        (new BoolArray([true]))
            ->setValueAlreadyExistMode(BoolArray::VALUE_ALREADY_EXIST_EXCEPTION)
            ->merge(new BoolArray([true, false]));
    }
}
