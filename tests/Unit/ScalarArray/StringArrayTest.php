<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ScalarArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\NullValueException,
    Exception\ValueAlreadyExistException,
    NullValueModeEnum,
    ScalarArray\StringArray,
    ValueAlreadyExistsModeEnum
};

final class StringArrayTest extends TestCase
{
    public function testCastValues(): void
    {
        $array = (new StringArray())
            ->setCastValues(true)
            ->setValues([1, 2.0, 3.1, '4', true, false, null]);

        static::assertCount(7, $array);
        static::assertSame('1', $array[0]);
        static::assertSame('2', $array[1]);
        static::assertSame('3.1', $array[2]);
        static::assertSame('4', $array[3]);
        static::assertSame('1', $array[4]);
        static::assertSame('', $array[5]);
        static::assertNull($array[6]);
    }

    public function testAllowString(): void
    {
        $array = new StringArray(['4']);

        static::assertCount(1, $array);
        static::assertSame('4', $array[0]);
    }

    public function testAllowNull(): void
    {
        $array = new StringArray([null]);

        static::assertCount(1, $array);
        static::assertNull($array[0]);
    }

    public function testNullValueModeDoNotAdd(): void
    {
        $array = (new StringArray())
            ->setNullValueMode(NullValueModeEnum::DO_NOT_ADD)
            ->setValues(['4', null]);

        static::assertCount(1, $array);
        static::assertSame('4', $array[0]);
    }

    public function testNullValueModeException(): void
    {
        static::expectException(NullValueException::class);
        (new StringArray())
            ->setNullValueMode(NullValueModeEnum::EXCEPTION)
            ->setValues([null]);
    }

    public function testDoNotCastInt(): void
    {
        static::expectException(InvalidTypeException::class);
        new StringArray([1]);
    }

    public function testDoNotCastFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        new StringArray([3.1]);
    }

    public function testDoNotCastBool(): void
    {
        static::expectException(InvalidTypeException::class);
        new StringArray([true]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new StringArray(['foo', 'bar']))
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::ADD)
            ->merge(new StringArray(['bar', 'baz']));

        static::assertCount(4, $array);
        static::assertSame('foo', $array[0]);
        static::assertSame('bar', $array[1]);
        static::assertSame('bar', $array[2]);
        static::assertSame('baz', $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new StringArray(['foo', 'bar']))
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::DO_NOT_ADD)
            ->merge(new StringArray(['bar', 'baz']));

        static::assertCount(3, $array);
        static::assertSame('foo', $array[0]);
        static::assertSame('bar', $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame('baz', $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistException::class);
        (new StringArray(['foo', 'bar']))
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::EXCEPTION)
            ->merge(new StringArray(['bar', 'baz']));
    }
}
