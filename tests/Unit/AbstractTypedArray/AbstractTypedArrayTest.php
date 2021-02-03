<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use PHPUnit\Framework\TestCase;

final class AbstractTypedArrayTest extends TestCase
{
    public function testResetKeys(): void
    {
        $array = new TypedArray([0 => 1, 1 => '2', 2 => null, 'foo' => 'foo']);

        static::assertSame([0, 1, 2, 'foo'], array_keys($array->toArray()));
        static::assertSame(1, $array[0]);
        static::assertSame('2', $array[1]);
        static::assertSame(null, $array[2]);
        static::assertSame('foo', $array['foo']);

        $array->resetKeys();

        static::assertSame([0, 1, 2, 3], array_keys($array->toArray()));
        static::assertSame(1, $array[0]);
        static::assertSame('2', $array[1]);
        static::assertSame(null, $array[2]);
        static::assertSame('foo', $array[3]);
    }

    public function testToArray(): void
    {
        $data = [0 => 1, 1 => '2', 2 => null, 'foo' => 'foo'];
        $array = new TypedArray($data);

        static::assertSame($data, $array->toArray());
    }
}
