<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ScalarCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ScalarCollection\StringNullableCollection
};

final class StringNullableCollectionTest extends TestCase
{
    public function testAllowString(): void
    {
        $collection = new StringNullableCollection(['4']);

        static::assertCount(1, $collection);
        static::assertSame('4', $collection->get(0));
    }

    public function testInvalidTypeInt(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringNullableCollection([1]);
    }

    public function testInvalidTypeFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringNullableCollection([3.1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new StringNullableCollection([true]);
    }

    public function testAllowNull(): void
    {
        $collection = new StringNullableCollection([null]);

        static::assertCount(1, $collection);
        static::assertNull($collection->get(0));
    }

    public function testMergeValueAlreadyExists(): void
    {
        $collection = (new StringNullableCollection(['foo', 'bar']))
            ->merge(new StringNullableCollection(['bar', 'baz']));

        static::assertCount(4, $collection);
        static::assertSame('foo', $collection->get(0));
        static::assertSame('bar', $collection->get(1));
        static::assertSame('bar', $collection->get(2));
        static::assertSame('baz', $collection->get(3));
    }
}
