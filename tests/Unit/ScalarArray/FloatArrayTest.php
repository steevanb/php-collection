<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ScalarArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\NullValueException,
    Exception\ValueAlreadyExistException,
    ScalarArray\FloatArray
};

final class FloatArrayTest extends TestCase
{
    public function testCastValues(): void
    {
        $array = (new FloatArray())
            ->setCastValues(true)
            ->setValues([1, 2.0, 3.1, '4', true, false, null]);

        static::assertCount(7, $array);
        static::assertSame(1.0, $array[0]);
        static::assertSame(2.0, $array[1]);
        static::assertSame(3.1, $array[2]);
        static::assertSame(4.0, $array[3]);
        static::assertSame(1.0, $array[4]);
        static::assertSame(0.0, $array[5]);
        static::assertNull($array[6]);
    }

    public function testAllowFloat(): void
    {
        $array = new FloatArray([1.0]);

        static::assertCount(1, $array);
        static::assertSame(1.0, $array[0]);
    }

    public function testAllowNull(): void
    {
        $array = new FloatArray([null]);

        static::assertCount(1, $array);
        static::assertNull($array[0]);
    }

    public function testNullValueModeDoNotAdd(): void
    {
        $array = (new FloatArray())
            ->setNullValueMode(FloatArray::NULL_VALUE_DO_NOT_ADD)
            ->setValues([1.0, null]);

        static::assertCount(1, $array);
        static::assertSame(1.0, $array[0]);
    }

    public function testNullValueModeException(): void
    {
        static::expectException(NullValueException::class);
        (new FloatArray())
            ->setNullValueMode(FloatArray::NULL_VALUE_EXCEPTION)
            ->setValues([null]);
    }

    public function testDoNotCastString(): void
    {
        static::expectException(InvalidTypeException::class);
        new FloatArray(['4']);
    }

    public function testDoNotCastInt(): void
    {
        static::expectException(InvalidTypeException::class);
        new FloatArray([1]);
    }

    public function testDoNotCastBool(): void
    {
        static::expectException(InvalidTypeException::class);
        new FloatArray([true]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new FloatArray([1.0, 2.0]))
            ->setValueAlreadyExistMode(FloatArray::VALUE_ALREADY_EXIST_ADD)
            ->merge(new FloatArray([1.0, 2.0]));

        static::assertCount(4, $array);
        static::assertSame(1.0, $array[0]);
        static::assertSame(2.0, $array[1]);
        static::assertSame(1.0, $array[2]);
        static::assertSame(2.0, $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new FloatArray([1.0, 2.0]))
            ->setValueAlreadyExistMode(FloatArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->merge(new FloatArray([2.0, 3.0]));

        static::assertCount(3, $array);
        static::assertSame(1.0, $array[0]);
        static::assertSame(2.0, $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame(3.0, $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistException::class);
        (new FloatArray([1.0, 2.0]))
            ->setValueAlreadyExistMode(FloatArray::VALUE_ALREADY_EXIST_EXCEPTION)
            ->merge(new FloatArray([2.0, 3.0]));
    }
}
