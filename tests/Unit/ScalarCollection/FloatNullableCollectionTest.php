<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ScalarCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ScalarCollection\FloatNullableCollection
};

final class FloatNullableCollectionTest extends TestCase
{
    public function testAllowFloat(): void
    {
        $collection = new FloatNullableCollection([1.0]);

        static::assertCount(1, $collection);
        static::assertSame(1.0, $collection->get(0));
    }

    public function testInvalidTypeString(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new FloatNullableCollection(['4']);
    }

    public function testInvalidTypeInt(): void
    {
        static::expectException(InvalidTypeException::class);
        new FloatNullableCollection([1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new FloatNullableCollection([true]);
    }

    public function testAllowNull(): void
    {
        $collection = new FloatNullableCollection([null]);

        static::assertCount(1, $collection);
        static::assertNull($collection->get(0));
    }

    public function testMergeValueAlreadyExists(): void
    {
        $collection = (new FloatNullableCollection([1.0, 2.0]))
            ->merge(new FloatNullableCollection([1.0, 2.0]));

        static::assertCount(4, $collection);
        static::assertSame(1.0, $collection->get(0));
        static::assertSame(2.0, $collection->get(1));
        static::assertSame(1.0, $collection->get(2));
        static::assertSame(2.0, $collection->get(3));
    }
}
