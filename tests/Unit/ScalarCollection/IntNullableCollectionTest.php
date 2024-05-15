<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ScalarCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ScalarCollection\IntegerNullableCollection
};

final class IntNullableCollectionTest extends TestCase
{
    public function testAllowInt(): void
    {
        $collection = new IntegerNullableCollection([1]);

        static::assertCount(1, $collection);
        static::assertSame(1, $collection->get(0));
    }

    public function testInvalidTypeString(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntegerNullableCollection(['4']);
    }

    public function testInvalidTypeFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntegerNullableCollection([3.1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntegerNullableCollection([true]);
    }

    public function testAllowNull(): void
    {
        $collection = new IntegerNullableCollection([null]);

        static::assertCount(1, $collection);
        static::assertNull($collection->get(0));
    }

    public function testMergeValueAlreadyExists(): void
    {
        $collection = (new IntegerNullableCollection([1, 2]))
            ->merge(new IntegerNullableCollection([1, 2]));

        static::assertCount(4, $collection);
        static::assertSame(1, $collection->get(0));
        static::assertSame(2, $collection->get(1));
        static::assertSame(1, $collection->get(2));
        static::assertSame(2, $collection->get(3));
    }
}
