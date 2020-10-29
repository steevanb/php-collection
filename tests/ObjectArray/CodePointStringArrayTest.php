<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ObjectArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\ValueAlreadyExistException,
    ObjectArray\CodePointStringArray,
    ObjectArray\UnicodeStringArray
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

    public function testComparisonModeString(): void
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

    public function testComparisonModeObjectHas(): void
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

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new CodePointStringArray([new CodePointString('foo'), new CodePointString('bar')]))
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_ADD)
            ->merge(new CodePointStringArray([new CodePointString('bar'), new CodePointString('baz')]));

        static::assertCount(4, $array);
        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
        static::assertSame('bar', (string) $array[2]);
        static::assertSame('baz', (string) $array[3]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new CodePointStringArray([new CodePointString('foo'), new CodePointString('bar')]))
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->merge(new CodePointStringArray([new CodePointString('bar'), new CodePointString('baz')]));

        static::assertCount(3, $array);
        static::assertSame('foo', (string) $array[0]);
        static::assertSame('bar', (string) $array[1]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame('baz', (string) $array[3]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistException::class);
        (new CodePointStringArray([new CodePointString('foo'), new CodePointString('bar')]))
            ->setValueAlreadyExistMode(UnicodeStringArray::VALUE_ALREADY_EXIST_EXCEPTION)
            ->merge(new CodePointStringArray([new CodePointString('bar'), new CodePointString('baz')]));
    }
}
