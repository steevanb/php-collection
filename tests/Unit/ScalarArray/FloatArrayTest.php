<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ScalarArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistsException,
    ScalarArray\FloatArray,
    ValueAlreadyExistsModeEnum
};

final class FloatArrayTest extends TestCase
{
    public function testAllowFloat(): void
    {
        $array = new FloatArray([1.0]);

        static::assertCount(1, $array);
        static::assertSame(1.0, $array[0]);
    }

    public function testInvalidTypeString(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new FloatArray(['4']);
    }

    public function testInvalidTypeInt(): void
    {
        static::expectException(InvalidTypeException::class);
        new FloatArray([1]);
    }

    public function testInvalidTypeBool(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new FloatArray([true]);
    }

    public function testInvalidTypeNull(): void
    {
        static::expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line */
        new FloatArray([null]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new FloatArray([1.0, 2.0], ValueAlreadyExistsModeEnum::ADD))
            ->merge(new FloatArray([1.0, 2.0]));

        static::assertCount(4, $array);
        static::assertSame(1.0, $array[0]);
        static::assertSame(2.0, $array[1]);
        static::assertSame(1.0, $array[2]);
        static::assertSame(2.0, $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new FloatArray([1.0, 2.0], ValueAlreadyExistsModeEnum::DO_NOT_ADD))
            ->merge(new FloatArray([2.0, 3.0]));

        static::assertCount(3, $array);
        static::assertSame(1.0, $array[0]);
        static::assertSame(2.0, $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame(3.0, $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        (new FloatArray([1.0, 2.0], ValueAlreadyExistsModeEnum::EXCEPTION))
            ->merge(new FloatArray([2.0, 3.0]));
    }
}
