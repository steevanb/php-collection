<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ObjectArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    ObjectArray\CodePointStringArray
};
use Symfony\Component\String\CodePointString;

final class CodePointStringArrayTest extends TestCase
{
    public function testConstructor(): void
    {
        $array = new CodePointStringArray([]);

        static::assertSame(CodePointString::class, $array->getClassName());
    }

    public function testCanAddValue(): void
    {
        $array = new CodePointStringArray(
            [
                new CodePointString('foo'),
                new CodePointString('bar'),
            ]
        );

        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
    }

    public function testCanAddValueException(): void
    {
        static::expectException(InvalidTypeException::class);
        new CodePointStringArray(
            [
                new CodePointString('foo'),
                new CodePointString('bar'),
                new \DateTime(),
            ]
        );
    }

    public function testCanAddValueObject(): void
    {
        $array = new CodePointStringArray(
            [
                new CodePointString('foo'),
                new CodePointString('bar'),
            ]
        );

        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
    }

    public function testComparidonModeString(): void
    {
        $array = (new CodePointStringArray())
            ->setValueAlreadyExistMode(CodePointStringArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->setValues(
                [
                    new CodePointString('foo'),
                    new CodePointString('foo'),
                    new CodePointString('bar'),
                ]
            );

        static::assertCount(2, $array);
        static::assertSame('foo', (string) $array[0]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame('bar', (string) $array[2]);
    }

    public function testComparidonModeObjectHas(): void
    {
        $array = (new CodePointStringArray())
            ->setComparisonMode(CodePointStringArray::COMPARISON_OBJECT_HASH)
            ->setValueAlreadyExistMode(CodePointStringArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->setValues(
                [
                    new CodePointString('foo'),
                    new CodePointString('foo'),
                    new CodePointString('bar'),
                ]
            );

        static::assertCount(3, $array);
        static::assertSame('foo', (string) $array[0]);
        static::assertSame('foo', (string) $array[1]);
        static::assertSame('bar', (string) $array[2]);
    }
}
