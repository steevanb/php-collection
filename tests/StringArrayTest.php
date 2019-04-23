<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\NonUniqueValueException,
    ScalarArray\StringArray
};

final class StringArrayTest extends TestCase
{
    public function testAllowSameValues(): void
    {
        $array = new StringArray(['foo', 'bar', 'foo']);
        static::assertCount(3, $array);
        static::assertSame('foo', $array[0]);
        static::assertSame('bar', $array[1]);
        static::assertSame('foo', $array[2]);
    }

    public function testUniqueValue(): void
    {
        $array = new StringArray(['foo', 'bar', 'foo'], false, true);
        static::assertCount(2, $array);
        static::assertSame('foo', $array[0]);
        static::assertSame('bar', $array[1]);
    }

    public function testUniqueValueException(): void
    {
        static::expectException(NonUniqueValueException::class);
        $array = new StringArray(['foo', 'bar', 'foo'], false, true, true);
    }

    public function testAutocast(): void
    {
        $array = new StringArray([1, 'foo'], true);
        static::assertCount(2, $array);
        static::assertSame('1', $array[0]);
        static::assertSame('foo', $array[1]);
    }
}
