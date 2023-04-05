<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

/** @covers \Steevanb\PhpCollection\AbstractCollection::hasKey */
final class HasKeyTest extends TestCase
{
    public function testStringKeys(): void
    {
        $collection = new TestCollection(['foo' => 1, 'bar' => '2', 'baz' => null]);

        static::assertTrue($collection->hasKey('foo'));
        static::assertTrue($collection->hasKey('bar'));
        static::assertTrue($collection->hasKey('baz'));
        static::assertFalse($collection->hasKey('qux'));
    }

    public function testIntegerKeys(): void
    {
        $collection = new TestCollection([0 => 1, 1 => '2', 3 => null]);

        static::assertTrue($collection->hasKey(0));
        static::assertFalse($collection->hasKey(2));
        static::assertTrue($collection->hasKey(1));
        static::assertTrue($collection->hasKey(3));
        static::assertFalse($collection->hasKey(4));
    }

    public function testMixedKeys(): void
    {
        $collection = new TestCollection([0 => 1, 'foo' => 'bar', 3 => null]);

        static::assertTrue($collection->hasKey(0));
        static::assertFalse($collection->hasKey(2));
        static::assertTrue($collection->hasKey('foo'));
        static::assertTrue($collection->hasKey(3));
        static::assertFalse($collection->hasKey(4));
    }
}
