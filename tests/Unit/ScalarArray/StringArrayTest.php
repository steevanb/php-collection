<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ScalarArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistsException,
    ScalarArray\StringArray,
    ValueAlreadyExistsModeEnum
};

final class StringArrayTest extends TestCase
{
    public function testAllowString(): void
    {
        $array = new StringArray(['4']);

        static::assertCount(1, $array);
        static::assertSame('4', $array[0]);
    }

    public function testInvalidTypeInt(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringArray([1]);
    }

    public function testInvalidTypeFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringArray([3.1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringArray([true]);
    }

    public function testInvalidTypeNull(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringArray([null]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new StringArray(['foo', 'bar'], ValueAlreadyExistsModeEnum::ADD))
            ->merge(new StringArray(['bar', 'baz']));

        static::assertCount(4, $array);
        static::assertSame('foo', $array[0]);
        static::assertSame('bar', $array[1]);
        static::assertSame('bar', $array[2]);
        static::assertSame('baz', $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new StringArray(['foo', 'bar'], ValueAlreadyExistsModeEnum::DO_NOT_ADD))
            ->merge(new StringArray(['bar', 'baz']));

        static::assertCount(3, $array);
        static::assertSame('foo', $array[0]);
        static::assertSame('bar', $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame('baz', $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        (new StringArray(['foo', 'bar'], ValueAlreadyExistsModeEnum::EXCEPTION))
            ->merge(new StringArray(['bar', 'baz']));
    }
}
