<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Goal of this class is to be "sure" of the behavior of array keys
 * @coversNothing
 */
final class ArrayTest extends TestCase
{
    public function testString(): void
    {
        $array = ['foo' => 'bar'];

        static::assertCount(1, $array);
        static::assertSame(['foo'], array_keys($array));
        static::assertArrayHasKey('foo', $array);
        static::assertSame('bar', $array['foo']);
    }

    public function testInt(): void
    {
        $array = [0 => 'bar'];

        static::assertCount(1, $array);
        static::assertSame([0], array_keys($array));
        static::assertArrayHasKey(0, $array);
        static::assertSame('bar', $array[0]);
    }

    public function testIntWithHole(): void
    {
        $array = [0 => 'foo', 1 => 'bar', 3 => 'baz', 10 => 'bou'];

        static::assertCount(4, $array);
        static::assertSame([0, 1, 3, 10], array_keys($array));
        static::assertArrayHasKey(0, $array);
        static::assertSame('foo', $array[0]);
        static::assertArrayHasKey(1, $array);
        static::assertSame('bar', $array[1]);
        static::assertArrayHasKey(3, $array);
        static::assertSame('baz', $array[3]);
        static::assertArrayHasKey(10, $array);
        static::assertSame('bou', $array[10]);
    }

    public function testFloat(): void
    {
        $array = [0.0 => 'foo', 0.4 => 'bar', 0.5 => 'baz', 0.6 => 'bou', 0.9 => 'bez'];

        static::assertCount(1, $array);
        static::assertSame([0], array_keys($array));
        static::assertArrayHasKey(0, $array);
        static::assertSame('bez', $array[0]);
    }

    public function testFloatWithHole(): void
    {
        $array = [0.9 => 'foo', 1.9 => 'bar', 3.9 => 'baz', 10.9 => 'bou'];

        static::assertCount(4, $array);
        static::assertSame([0, 1, 3, 10], array_keys($array));
        static::assertArrayHasKey(0, $array);
        static::assertSame('foo', $array[0]);
        static::assertArrayHasKey(1, $array);
        static::assertSame('bar', $array[1]);
        static::assertArrayHasKey(3, $array);
        static::assertSame('baz', $array[3]);
        static::assertArrayHasKey(10, $array);
        static::assertSame('bou', $array[10]);
    }

    public function testBool(): void
    {
        $array = [true => 'foo', false => 'bar'];

        static::assertCount(2, $array);
        static::assertSame([1, 0], array_keys($array));
        static::assertArrayHasKey(0, $array);
        static::assertSame('bar', $array[0]);
        static::assertArrayHasKey(1, $array);
        static::assertSame('foo', $array[1]);
    }

    public function testNull(): void
    {
        $array = [null => 'foo', null => 'bar'];

        static::assertCount(1, $array);
        static::assertSame([''], array_keys($array));
        static::assertArrayHasKey('', $array);
        static::assertSame('bar', $array['']);
    }

    public function testStringInt(): void
    {
        $array = [0 => 'foo', 'key' => 'bar', 10 => 'baz', 'key2' => 'bou'];

        static::assertCount(4, $array);
        static::assertSame([0, 'key', 10, 'key2'], array_keys($array));
        static::assertArrayHasKey(0, $array);
        static::assertSame('foo', $array[0]);
        static::assertArrayHasKey(0, $array);
        static::assertSame('bar', $array['key']);
        static::assertArrayHasKey(0, $array);
        static::assertSame('baz', $array[10]);
        static::assertArrayHasKey(0, $array);
        static::assertSame('bou', $array['key2']);
    }

    public function testStdClass(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Illegal offset type');
        [new \stdClass() => 'foo'];
    }

    public function testStringableObject(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Illegal offset type');
        [new StringableObject() => 'foo'];
    }
}
