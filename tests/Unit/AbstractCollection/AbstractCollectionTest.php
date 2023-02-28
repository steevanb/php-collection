<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

final class AbstractCollectionTest extends TestCase
{
    public function testResetKeys(): void
    {
        $collection = new Collection([0 => 1, 1 => '2', 2 => null, 'foo' => 'foo']);

        static::assertSame([0, 1, 2, 'foo'], array_keys($collection->toArray()));
        static::assertSame(1, $collection->callDoGet(0));
        static::assertSame('2', $collection->callDoGet(1));
        static::assertNull($collection->callDoGet(2));
        static::assertSame('foo', $collection->callDoGet('foo'));

        $collection->resetKeys();

        static::assertSame([0, 1, 2, 3], array_keys($collection->toArray()));
        static::assertSame(1, $collection->callDoGet(0));
        static::assertSame('2', $collection->callDoGet(1));
        static::assertNull($collection->callDoGet(2));
        static::assertSame('foo', $collection->callDoGet(3));
    }

    public function testToArray(): void
    {
        $data = [0 => 1, 1 => '2', 2 => null, 'foo' => 'foo'];
        $collection = new Collection($data);

        static::assertSame($data, $collection->toArray());
    }
}
