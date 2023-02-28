<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ScalarCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistsException,
    ScalarCollection\StringCollection,
    ValueAlreadyExistsModeEnum
};

final class StringCollectionTest extends TestCase
{
    public function testAllowString(): void
    {
        $collection = new StringCollection(['4']);

        static::assertCount(1, $collection);
        static::assertSame('4', $collection[0]);
    }

    public function testInvalidTypeInt(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringCollection([1]);
    }

    public function testInvalidTypeFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringCollection([3.1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringCollection([true]);
    }

    public function testInvalidTypeNull(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringCollection([null]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $collection = (new StringCollection(['foo', 'bar'], ValueAlreadyExistsModeEnum::ADD))
            ->merge(new StringCollection(['bar', 'baz']));

        static::assertCount(4, $collection);
        static::assertSame('foo', $collection[0]);
        static::assertSame('bar', $collection[1]);
        static::assertSame('bar', $collection[2]);
        static::assertSame('baz', $collection[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $collection = (new StringCollection(['foo', 'bar'], ValueAlreadyExistsModeEnum::DO_NOT_ADD))
            ->merge(new StringCollection(['bar', 'baz']));

        static::assertCount(3, $collection);
        static::assertSame('foo', $collection[0]);
        static::assertSame('bar', $collection[1]);
        // @see https://github.com/steevanb/php-collection/issues/15
        static::assertSame('baz', $collection[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        (new StringCollection(['foo', 'bar'], ValueAlreadyExistsModeEnum::EXCEPTION))
            ->merge(new StringCollection(['bar', 'baz']));
    }
}
