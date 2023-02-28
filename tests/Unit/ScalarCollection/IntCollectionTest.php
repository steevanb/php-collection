<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ScalarCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistsException,
    ScalarCollection\IntegerCollection,
    ValueAlreadyExistsModeEnum
};

final class IntCollectionTest extends TestCase
{
    public function testAllowInt(): void
    {
        $collection = new IntegerCollection([1]);

        static::assertCount(1, $collection);
        static::assertSame(1, $collection->get(0));
    }

    public function testInvalidTypeString(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntegerCollection(['4']);
    }

    public function testInvalidTypeFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntegerCollection([3.1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntegerCollection([true]);
    }

    public function testInvalidTypeNull(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntegerCollection([null]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $collection = (new IntegerCollection([1, 2], ValueAlreadyExistsModeEnum::ADD))
            ->merge(new IntegerCollection([1, 2]));

        static::assertCount(4, $collection);
        static::assertSame(1, $collection->get(0));
        static::assertSame(2, $collection->get(1));
        static::assertSame(1, $collection->get(2));
        static::assertSame(2, $collection->get(3));
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $collection = (new IntegerCollection([1, 2], ValueAlreadyExistsModeEnum::DO_NOT_ADD))
            ->merge(new IntegerCollection([2, 3]));

        static::assertCount(3, $collection);
        static::assertSame(1, $collection->get(0));
        static::assertSame(2, $collection->get(1));
        // @see https://github.com/steevanb/php-collection/issues/15
        static::assertSame(3, $collection->get(3));
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        (new IntegerCollection([1, 2], ValueAlreadyExistsModeEnum::EXCEPTION))
            ->merge(new IntegerCollection([2, 3]));
    }
}
