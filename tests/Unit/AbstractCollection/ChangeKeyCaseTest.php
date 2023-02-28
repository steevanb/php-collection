<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

final class ChangeKeyCaseTest extends TestCase
{
    public function testDefaultParameters(): void
    {
        $collection = new Collection(['foo' => 1]);

        $collection->changeKeyCase();

        static::assertCount(1, $collection);
        static::assertArrayHasKey('foo', $collection->toArray());
        static::assertSame(1, $collection['foo']);
    }

    public function testLowerCaseAssociativesKeys(): void
    {
        $collection = new Collection(['foo' => 1, 'BaR' => 2, 'BAZ' => 3]);

        $collection->changeKeyCase(CASE_LOWER);

        static::assertCount(3, $collection);
        static::assertArrayHasKey('foo', $collection->toArray());
        static::assertSame(1, $collection['foo']);
        static::assertArrayHasKey('bar', $collection->toArray());
        static::assertSame(2, $collection['bar']);
        static::assertArrayHasKey('baz', $collection->toArray());
        static::assertSame(3, $collection['baz']);
    }

    public function testUpperCaseAssociativesKeys(): void
    {
        $acollectionray = new Collection(['foo' => 1, 'BaR' => 2, 'BAZ' => 3]);

        $acollectionray->changeKeyCase(CASE_UPPER);

        static::assertCount(3, $acollectionray);
        static::assertArrayHasKey('FOO', $acollectionray->toArray());
        static::assertSame(1, $acollectionray['FOO']);
        static::assertArrayHasKey('BAR', $acollectionray->toArray());
        static::assertSame(2, $acollectionray['BAR']);
        static::assertArrayHasKey('BAZ', $acollectionray->toArray());
        static::assertSame(3, $acollectionray['BAZ']);
    }

    public function testLowerCaseIndexedKeys(): void
    {
        $collection = new Collection([0 => 1, 10 => 2, 20 => 3]);

        $collection->changeKeyCase(CASE_LOWER);

        static::assertCount(3, $collection);
        static::assertArrayHasKey(0, $collection->toArray());
        static::assertSame(1, $collection[0]);
        static::assertArrayHasKey(10, $collection->toArray());
        static::assertSame(2, $collection[10]);
        static::assertArrayHasKey(20, $collection->toArray());
        static::assertSame(3, $collection[20]);
    }

    public function testUpperCaseIndexedKeys(): void
    {
        $collection = new Collection([0 => 1, 10 => 2, 20 => 3]);

        $collection->changeKeyCase(CASE_UPPER);

        static::assertCount(3, $collection);
        static::assertArrayHasKey(0, $collection->toArray());
        static::assertSame(1, $collection[0]);
        static::assertArrayHasKey(10, $collection->toArray());
        static::assertSame(2, $collection[10]);
        static::assertArrayHasKey(20, $collection->toArray());
        static::assertSame(3, $collection[20]);
    }

    public function testEmpty(): void
    {
        $collection = new Collection();

        static::assertCount(0, $collection);

        $collection->changeKeyCase();

        static::assertCount(0, $collection);
    }

    public function testReturnType(): void
    {
        $collection = new Collection();

        static::assertSame($collection, $collection->changeKeyCase());
    }
}
