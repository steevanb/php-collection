<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ScalarArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    Exception\NullValueException,
    Exception\ValueAlreadyExistException,
    NullValueModeEnum,
    ScalarArray\ScalarArray,
    ValueAlreadyExistsModeEnum
};

final class ScalarArrayTest extends TestCase
{
    public function testAllowString(): void
    {
        $array = (new ScalarArray(['4']));

        static::assertCount(1, $array);
        static::assertSame('4', $array[0]);
    }

    public function testDisallowString(): void
    {
        static::expectException(InvalidTypeException::class);
        (new ScalarArray())
            ->setAllowString(false)
            ->setValues(['4']);
    }

    public function testAllowInt(): void
    {
        $array = (new ScalarArray([1]));

        static::assertCount(1, $array);
        static::assertSame(1, $array[0]);
    }

    public function testDisallowInt(): void
    {
        static::expectException(InvalidTypeException::class);
        (new ScalarArray())
            ->setAllowInt(false)
            ->setValues([1]);
    }

    public function testAllowFloat(): void
    {
        $array = (new ScalarArray([2.0, 3.1]));

        static::assertCount(2, $array);
        static::assertSame(2.0, $array[0]);
        static::assertSame(3.1, $array[1]);
    }

    public function testDisallowFloat(): void
    {
        static::expectException(InvalidTypeException::class);
        (new ScalarArray())
            ->setAllowFloat(false)
            ->setValues([2.0]);
    }

    public function testAllowBool(): void
    {
        $array = (new ScalarArray([true, false]));

        static::assertCount(2, $array);
        static::assertTrue($array[0]);
        static::assertFalse($array[1]);
    }

    public function testDisallowBool(): void
    {
        static::expectException(InvalidTypeException::class);
        (new ScalarArray())
            ->setAllowBool(false)
            ->setValues([true]);
    }

    public function testAllowNull(): void
    {
        $array = new ScalarArray([null]);

        static::assertCount(1, $array);
        static::assertNull($array[0]);
    }

    public function testNullValueModeDoNotAdd(): void
    {
        $array = (new ScalarArray())
            ->setNullValueMode(NullValueModeEnum::DO_NOT_ADD)
            ->setValues([1, null]);

        static::assertCount(1, $array);
        static::assertSame(1, $array[0]);
    }

    public function testNullValueModeException(): void
    {
        static::expectException(NullValueException::class);
        (new ScalarArray())
            ->setNullValueMode(NullValueModeEnum::EXCEPTION)
            ->setValues([null]);
    }

    public function testMergeValueAlreadyExistsAdd(): void
    {
        $array = (new ScalarArray([1, 2.0, 3.1, '4', true, false, null]))
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::ADD)
            ->merge(new ScalarArray([1, 2.0, 3.1, '4', true, false, null]));

        static::assertCount(14, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2.0, $array[1]);
        static::assertSame(3.1, $array[2]);
        static::assertSame('4', $array[3]);
        static::assertTrue($array[4]);
        static::assertFalse($array[5]);
        static::assertNull($array[6]);
        static::assertSame(1, $array[7]);
        static::assertSame(2.0, $array[8]);
        static::assertSame(3.1, $array[9]);
        static::assertSame('4', $array[10]);
        static::assertTrue($array[11]);
        static::assertFalse($array[12]);
        static::assertNull($array[13]);
    }

    public function testMergeValueAlreadyExistsDoNotAdd(): void
    {
        $array = (new ScalarArray([1]))
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::DO_NOT_ADD)
            ->merge(new ScalarArray([1, '4']));

        static::assertCount(2, $array);
        static::assertSame(1, $array[0]);
        // @see https://github.com/steevanb/php-typed-array/issues/15
        static::assertSame('4', $array[2]);
    }

    public function testMergeValueAlreadyExistsException(): void
    {
        static::expectException(ValueAlreadyExistException::class);
        (new ScalarArray([1]))
            ->setValueAlreadyExistMode(ValueAlreadyExistsModeEnum::EXCEPTION)
            ->merge(new ScalarArray([1, '4']));
    }
}
