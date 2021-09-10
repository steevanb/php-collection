<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use PHPUnit\Framework\TestCase;

final class ChangeKeyCaseTest extends TestCase
{
    public function testDefaultParameters(): void
    {
        $array = new TypedArray(['foo' => 1]);

        $array->changeKeyCase();

        static::assertCount(1, $array);
        static::assertArrayHasKey('foo', $array->toArray());
        static::assertSame(1, $array['foo']);
    }

    public function testLowerCaseAssociativesKeys(): void
    {
        $array = new TypedArray(['foo' => 1, 'BaR' => 2, 'BAZ' => 3]);

        $array->changeKeyCase(CASE_LOWER);

        static::assertCount(3, $array);
        static::assertArrayHasKey('foo', $array->toArray());
        static::assertSame(1, $array['foo']);
        static::assertArrayHasKey('bar', $array->toArray());
        static::assertSame(2, $array['bar']);
        static::assertArrayHasKey('baz', $array->toArray());
        static::assertSame(3, $array['baz']);
    }

    public function testUpperCaseAssociativesKeys(): void
    {
        $array = new TypedArray(['foo' => 1, 'BaR' => 2, 'BAZ' => 3]);

        $array->changeKeyCase(CASE_UPPER);

        static::assertCount(3, $array);
        static::assertArrayHasKey('FOO', $array->toArray());
        static::assertSame(1, $array['FOO']);
        static::assertArrayHasKey('BAR', $array->toArray());
        static::assertSame(2, $array['BAR']);
        static::assertArrayHasKey('BAZ', $array->toArray());
        static::assertSame(3, $array['BAZ']);
    }

    public function testLowerCaseIndexedKeys(): void
    {
        $array = new TypedArray([0 => 1, 10 => 2, 20 => 3]);

        $array->changeKeyCase(CASE_LOWER);

        static::assertCount(3, $array);
        static::assertArrayHasKey(0, $array->toArray());
        static::assertSame(1, $array[0]);
        static::assertArrayHasKey(10, $array->toArray());
        static::assertSame(2, $array[10]);
        static::assertArrayHasKey(20, $array->toArray());
        static::assertSame(3, $array[20]);
    }

    public function testUpperCaseIndexedKeys(): void
    {
        $array = new TypedArray([0 => 1, 10 => 2, 20 => 3]);

        $array->changeKeyCase(CASE_UPPER);

        static::assertCount(3, $array);
        static::assertArrayHasKey(0, $array->toArray());
        static::assertSame(1, $array[0]);
        static::assertArrayHasKey(10, $array->toArray());
        static::assertSame(2, $array[10]);
        static::assertArrayHasKey(20, $array->toArray());
        static::assertSame(3, $array[20]);
    }

    public function testEmpty(): void
    {
        $array = new TypedArray();

        static::assertCount(0, $array);

        $array->changeKeyCase();

        static::assertCount(0, $array);
    }

    public function testReturnType(): void
    {
        $array = new TypedArray();

        static::assertSame($array, $array->changeKeyCase());
    }
}
