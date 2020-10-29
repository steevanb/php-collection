<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ScalarArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistException,
    ScalarArray\IntArray
};

final class IntArrayTest extends TestCase
{
    public function testCastValues(): void
    {
        $array = (new IntArray())
            ->setCastValues(true)
            ->setValues([1, '2']);

        static::assertCount(2, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
    }

    public function testCastInvalidValue(): void
    {
        static::expectException(InvalidTypeException::class);

        (new IntArray())
            ->setCastValues(true)
            ->setValues([1, '2', 'foo']);
    }

    public function testDoNotCastValues(): void
    {
        static::expectException(InvalidTypeException::class);
        new IntArray([1, '2']);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new IntArray([1, 2]))
            ->setValueAlreadyExistMode(IntArray::VALUE_ALREADY_EXIST_ADD)
            ->merge(new IntArray([2, 3]));

        static::assertCount(4, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        static::assertSame(2, $array[2]);
        static::assertSame(3, $array[3]);
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
