<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ObjectArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistException,
    ObjectArray\UnicodeStringArray
};
use Symfony\Component\String\UnicodeString;

final class UnicodeStringArrayTest extends TestCase
{
    public function testConstructor(): void
    {
        $array = new UnicodeStringArray([]);

        static::assertSame(UnicodeString::class, $array->getClassName());
    }

    public function testCanAddValue(): void
    {
        $array = new UnicodeStringArray(
            [
                new UnicodeString('foo'),
                new UnicodeString('bar'),
            ]
        );

        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
    }

    public function testCanAddValueException(): void
    {
        static::expectException(InvalidTypeException::class);
        new UnicodeStringArray(
            /** @phpstan-ignore-next-line */
            [
                new UnicodeString('foo'),
                new UnicodeString('bar'),
                new \DateTime(),
            ]
        );
    }

    public function testCanAddValueObject(): void
    {
        $array = new UnicodeStringArray(
            [
                new UnicodeString('foo'),
                new UnicodeString('bar'),
            ]
        );

        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
    }

    public function testComparisonModeString(): void
    {
        $array = (new UnicodeStringArray())
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->setValues(
                [
                    new UnicodeString('foo'),
                    new UnicodeString('foo'),
                    new UnicodeString('bar'),
                ]
            );

        static::assertCount(2, $array);
        static::assertSame('foo', (string) $array[0]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame('bar', (string) $array[2]);
    }

    public function testComparisonModeObjectHas(): void
    {
        $array = (new UnicodeStringArray())
            ->setComparisonMode(UnicodeStringArray::COMPARISON_OBJECT_HASH)
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->setValues(
                [
                    new UnicodeString('foo'),
                    new UnicodeString('foo'),
                    new UnicodeString('bar'),
                ]
            );

        static::assertCount(3, $array);
        static::assertSame('foo', (string) $array[0]);
        static::assertSame('foo', (string) $array[1]);
        static::assertSame('bar', (string) $array[2]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new UnicodeStringArray([new UnicodeString('foo'), new UnicodeString('bar')]))
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_ADD)
            ->merge(new UnicodeStringArray([new UnicodeString('bar'), new UnicodeString('baz')]));

        static::assertCount(4, $array);
        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
        static::assertSame('bar', (string) $array[2]);
        static::assertSame('baz', (string) $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new UnicodeStringArray([new UnicodeString('foo'), new UnicodeString('bar')]))
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->merge(new UnicodeStringArray([new UnicodeString('bar'), new UnicodeString('baz')]));

        static::assertCount(3, $array);
        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame('baz', (string) $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistException::class);
        (new UnicodeStringArray([new UnicodeString('foo'), new UnicodeString('bar')]))
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_EXCEPTION)
            ->merge(new UnicodeStringArray([new UnicodeString('bar'), new UnicodeString('baz')]));
    }
}
