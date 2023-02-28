<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ScalarCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistsException,
    ScalarCollection\IntCollection,
    ValueAlreadyExistsModeEnum
};

final class IntCollectionTest extends TestCase
{
    public function testAllowInt(): void
    {
        $collection = new IntCollection([1]);

        static::assertCount(1, $collection);
        static::assertSame(1, $collection[0]);
    }

    public function testInvalidTypeString(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntCollection(['4']);
    }

    public function testInvalidTypeFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntCollection([3.1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntCollection([true]);
    }

    public function testInvalidTypeNull(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new IntCollection([null]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $collection = (new IntCollection([1, 2], ValueAlreadyExistsModeEnum::ADD))
            ->merge(new IntCollection([1, 2]));

        static::assertCount(4, $collection);
        static::assertSame(1, $collection[0]);
        static::assertSame(2, $collection[1]);
        static::assertSame(1, $collection[2]);
        static::assertSame(2, $collection[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $collection = (new IntCollection([1, 2], ValueAlreadyExistsModeEnum::DO_NOT_ADD))
            ->merge(new IntCollection([2, 3]));

        static::assertCount(3, $collection);
        static::assertSame(1, $collection[0]);
        static::assertSame(2, $collection[1]);
        // @see https://github.com/steevanb/php-collection/issues/15
        static::assertSame(3, $collection[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        (new IntCollection([1, 2], ValueAlreadyExistsModeEnum::EXCEPTION))
            ->merge(new IntCollection([2, 3]));
    }
}
