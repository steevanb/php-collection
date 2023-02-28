<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ScalarCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistsException,
    ScalarCollection\IntNullableCollection,
    ValueAlreadyExistsModeEnum
};

final class IntNullableCollectionTest extends TestCase
{
    public function testAllowInt(): void
    {
        $collection = new IntNullableCollection([1]);

        static::assertCount(1, $collection);
        static::assertSame(1, $collection[0]);
    }

    public function testInvalidTypeString(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntNullableCollection(['4']);
    }

    public function testInvalidTypeFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntNullableCollection([3.1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntNullableCollection([true]);
    }

    public function testAllowNull(): void
    {
        $collection = new IntNullableCollection([null]);

        static::assertCount(1, $collection);
        static::assertNull($collection[0]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $collection = (new IntNullableCollection([1, 2], ValueAlreadyExistsModeEnum::ADD))
            ->merge(new IntNullableCollection([1, 2]));

        static::assertCount(4, $collection);
        static::assertSame(1, $collection[0]);
        static::assertSame(2, $collection[1]);
        static::assertSame(1, $collection[2]);
        static::assertSame(2, $collection[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $collection = (new IntNullableCollection([1, 2], ValueAlreadyExistsModeEnum::DO_NOT_ADD))
            ->merge(new IntNullableCollection([2, 3]));

        static::assertCount(3, $collection);
        static::assertSame(1, $collection[0]);
        static::assertSame(2, $collection[1]);
        // @see https://github.com/steevanb/php-collection/issues/15
        static::assertSame(3, $collection[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        (new IntNullableCollection([1, 2], ValueAlreadyExistsModeEnum::EXCEPTION))
            ->merge(new IntNullableCollection([2, 3]));
    }
}
