<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ScalarArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistException,
    ScalarArray\StringArray
};

final class StringArrayTest extends TestCase
{
    public function testCastValues(): void
    {
        $array = (new StringArray())
            ->setCastValues(true)
            ->setValues([1, '2', null]);

        static::assertSame('1', $array[0]);
        static::assertSame('2', $array[1]);
        static::assertSame(null, $array[2]);
    }

    public function testDoNotCastValues(): void
    {
        static::expectException(InvalidTypeException::class);
        new StringArray([1, '2']);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new StringArray(['foo', 'bar']))
            ->setValueAlreadyExistMode(StringArray::VALUE_ALREADY_EXIST_ADD)
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
            ->setValueAlreadyExistMode(StringArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
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
            ->setValueAlreadyExistMode(StringArray::VALUE_ALREADY_EXIST_EXCEPTION)
            ->merge(new StringArray(['bar', 'baz']));
    }
}
