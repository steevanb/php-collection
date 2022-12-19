<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Bridge\Symfony\ObjectArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistException,
    ObjectArray\ByteStringArray,
    ObjectComparisonModeEnum,
    ValueAlreadyExistsModeEnum
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
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::DO_NOT_ADD)
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
            ->setComparisonMode(ObjectComparisonModeEnum::HASH)
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::DO_NOT_ADD)
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
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::ADD)
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
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::DO_NOT_ADD)
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
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::EXCEPTION)
            ->merge(new ByteStringArray([new ByteString('bar'), new ByteString('baz')]));
    }
}
