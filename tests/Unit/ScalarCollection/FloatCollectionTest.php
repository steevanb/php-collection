<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ScalarCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ScalarCollection\FloatCollection
};

final class FloatCollectionTest extends TestCase
{
    public function testAllowFloat(): void
    {
        $collection = new FloatCollection([1.0]);

        static::assertCount(1, $collection);
        static::assertSame(1.0, $collection->get(0));
    }

    public function testInvalidTypeString(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new FloatCollection(['4']);
    }

    public function testInvalidTypeInt(): void
    {
        static::expectException(InvalidTypeException::class);
        new FloatCollection([1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new FloatCollection([true]);
    }

    public function testInvalidTypeNull(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new FloatCollection([null]);
    }

    public function testMergeValueAlreadyExists(): void
    {
        $collection = (new FloatCollection([1.0, 2.0]))
            ->merge(new FloatCollection([1.0, 2.0]));

        static::assertCount(4, $collection);
        static::assertSame(1.0, $collection->get(0));
        static::assertSame(2.0, $collection->get(1));
        static::assertSame(1.0, $collection->get(2));
        static::assertSame(2.0, $collection->get(3));
    }
}
