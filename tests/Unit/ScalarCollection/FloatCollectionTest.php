<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ScalarCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistsException,
    ScalarCollection\FloatCollection,
    ValueAlreadyExistsModeEnum
};

final class FloatCollectionTest extends TestCase
{
    public function testAllowFloat(): void
    {
        $collection = new FloatCollection([1.0]);

        static::assertCount(1, $collection);
        static::assertSame(1.0, $collection[0]);
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

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $collection = (new FloatCollection([1.0, 2.0], ValueAlreadyExistsModeEnum::ADD))
            ->merge(new FloatCollection([1.0, 2.0]));

        static::assertCount(4, $collection);
        static::assertSame(1.0, $collection[0]);
        static::assertSame(2.0, $collection[1]);
        static::assertSame(1.0, $collection[2]);
        static::assertSame(2.0, $collection[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $collection = (new FloatCollection([1.0, 2.0], ValueAlreadyExistsModeEnum::DO_NOT_ADD))
            ->merge(new FloatCollection([2.0, 3.0]));

        static::assertCount(3, $collection);
        static::assertSame(1.0, $collection[0]);
        static::assertSame(2.0, $collection[1]);
        // @see https://github.com/steevanb/php-collection/issues/15
        static::assertSame(3.0, $collection[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        (new FloatCollection([1.0, 2.0], ValueAlreadyExistsModeEnum::EXCEPTION))
            ->merge(new FloatCollection([2.0, 3.0]));
    }
}
