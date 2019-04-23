<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ScalarArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    ScalarArray\IntArray
};

final class IntArrayTest extends TestCase
{
    public function testCastValues(): void
    {
        $array = (new IntArray())
            ->setCastValues(true)
            ->setValues([1, '2']);

        static::assertCount(2, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
    }

    public function testCastInvalidValue(): void
    {
        static::expectException(InvalidTypeException::class);

        (new IntArray())
            ->setCastValues(true)
            ->setValues([1, '2', 'foo']);
    }

    public function testDoNotCastValues(): void
    {
        static::expectException(InvalidTypeException::class);
        new IntArray([1, '2']);
    }
}
