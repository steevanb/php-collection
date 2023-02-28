<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

final class IteratorTest extends TestCase
{
    public function testCurrent(): void
    {
        $collection = new Collection([1, '2', null]);

        static::assertSame(1, $collection->current());
    }

    public function testNext(): void
    {
        $collection = new Collection([1, '2', null]);

        $collection->next();
        static::assertSame(1, $collection->key());
        static::assertSame('2', $collection->current());
    }

    public function testKey(): void
    {
        $collection = new Collection([1, '2', null]);

        $countValues = count($collection);
        for ($i = 0; $i < $countValues; $i++) {
            static::assertSame($i, $collection->key());
            $collection->next();
        }
        static::assertNull($collection->key());
    }

    public function testValid(): void
    {
        $collection = new Collection([1, '2', null]);

        $countValues = count($collection);
        for ($i = 0; $i < $countValues; $i++) {
            static::assertTrue($collection->valid());
            $collection->next();
        }
        static::assertFalse($collection->valid());
    }

    public function testRewind(): void
    {
        $collection = new Collection([1, '2', null]);

        static::assertSame(0, $collection->key());
        $collection->next();
        static::assertSame(1, $collection->key());
        $collection->next();
        static::assertSame(2, $collection->key());
        $collection->rewind();
        static::assertSame(0, $collection->key());
    }
}
