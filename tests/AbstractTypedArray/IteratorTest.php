<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\AbstractTypedArray;

use PHPUnit\Framework\TestCase;

final class IteratorTest extends TestCase
{
    public function testCurrent(): void
    {
        $array = new TypedArray([1, '2', null]);

        static::assertSame(1, $array->current());
    }

    public function testNext(): void
    {
        $array = new TypedArray([1, '2', null]);

        $array->next();
        static::assertSame(1, $array->key());
        static::assertSame('2', $array->current());
    }

    public function testKey(): void
    {
        $array = new TypedArray([1, '2', null]);

        $countValues = count($array);
        for ($i = 0; $i < $countValues; $i++) {
            static::assertSame($i, $array->key());
            $array->next();
        }
        static::assertSame(null, $array->key());
    }

    public function testValid(): void
    {
        $array = new TypedArray([1, '2', null]);

        $countValues = count($array);
        for ($i = 0; $i < $countValues; $i++) {
            static::assertSame(true, $array->valid());
            $array->next();
        }
        static::assertSame(false, $array->valid());
    }

    public function testRewind(): void
    {
        $array = new TypedArray([1, '2', null]);

        static::assertSame(0, $array->key());
        $array->next();
        static::assertSame(1, $array->key());
        $array->next();
        static::assertSame(2, $array->key());
        $array->rewind();
        static::assertSame(0, $array->key());
    }
}
