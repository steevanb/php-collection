<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ObjectArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
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

    public function testComparidonModeString(): void
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

    public function testComparidonModeObjectHas(): void
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
}
