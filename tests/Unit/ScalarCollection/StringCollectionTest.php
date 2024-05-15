<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ScalarCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ScalarCollection\StringCollection
};

final class StringCollectionTest extends TestCase
{
    public function testAllowString(): void
    {
        $collection = new StringCollection(['4']);

        static::assertCount(1, $collection);
        static::assertSame('4', $collection->get(0));
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

    public function testMergeValueAlreadyExists(): void
    {
        $collection = (new StringCollection(['foo', 'bar']))
            ->merge(new StringCollection(['bar', 'baz']));

        static::assertCount(4, $collection);
        static::assertSame('foo', $collection->get(0));
        static::assertSame('bar', $collection->get(1));
        static::assertSame('bar', $collection->get(2));
        static::assertSame('baz', $collection->get(3));
    }
}
