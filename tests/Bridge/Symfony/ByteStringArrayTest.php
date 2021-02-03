<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Bridge\Symfony;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistException,
    ObjectArray\ByteStringArray,
    ObjectArray\UnicodeStringArray
};
use Symfony\Component\String\ByteString;

final class ByteStringArrayTest extends TestCase
{
    public function testConstructor(): void
    {
        $array = new ByteStringArray([]);

        static::assertSame(ByteString::class, $array->getClassName());
    }

    public function testCanAddValue(): void
    {
        $array = new ByteStringArray(
            [
                new ByteString('foo'),
                new ByteString('bar'),
            ]
        );

        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
    }

    public function testCanAddValueException(): void
    {
        static::expectException(InvalidTypeException::class);
        new ByteStringArray(
            [
                new ByteString('foo'),
                new ByteString('bar'),
                new \DateTime(),
            ]
        );
    }

    public function testCanAddValueObject(): void
    {
        $array = new ByteStringArray(
            [
                new ByteString('foo'),
                new ByteString('bar'),
            ]
        );

        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
    }

    public function testComparisonModeString(): void
    {
        $array = (new ByteStringArray())
            ->setValueAlreadyExistMode(ByteStringArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->setValues(
                [
                    new ByteString('foo'),
                    new ByteString('foo'),
                    new ByteString('bar'),
                ]
            );

        static::assertCount(2, $array);
        static::assertSame('foo', (string) $array[0]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame('bar', (string) $array[2]);
    }

    public function testComparisonModeObjectHas(): void
    {
        $array = (new ByteStringArray())
            ->setComparisonMode(ByteStringArray::COMPARISON_OBJECT_HASH)
            ->setValueAlreadyExistMode(ByteStringArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->setValues(
                [
                    new ByteString('foo'),
                    new ByteString('foo'),
                    new ByteString('bar'),
                ]
            );

        static::assertCount(3, $array);
        static::assertSame('foo', (string) $array[0]);
        static::assertSame('foo', (string) $array[1]);
        static::assertSame('bar', (string) $array[2]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new ByteStringArray([new ByteString('foo'), new ByteString('bar')]))
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_ADD)
            ->merge(new ByteStringArray([new ByteString('bar'), new ByteString('baz')]));

        static::assertCount(4, $array);
        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
        static::assertSame('bar', (string) $array[2]);
        static::assertSame('baz', (string) $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new ByteStringArray([new ByteString('foo'), new ByteString('bar')]))
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->merge(new ByteStringArray([new ByteString('bar'), new ByteString('baz')]));

        static::assertCount(3, $array);
        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame('baz', (string) $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistException::class);
        (new ByteStringArray([new ByteString('foo'), new ByteString('bar')]))
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_EXCEPTION)
            ->merge(new ByteStringArray([new ByteString('bar'), new ByteString('baz')]));
    }
}
