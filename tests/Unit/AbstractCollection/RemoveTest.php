<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Exception\KeyNotFoundException;

final class RemoveTest extends TestCase
{
    public function testRemove(): void
    {
        $collection = new Collection([1, '2', null]);

        static::assertCount(3, $collection);

        $collection->remove(1);

        static::assertCount(2, $collection);
        static::assertSame(1, $collection->get(0));
        static::assertNull($collection->get(2));
        static::assertFalse($collection->hasKey(1));
    }

    public function testKeyNotFound(): void
    {
        $collection = new Collection([1, '2', null]);

        $this->expectException(KeyNotFoundException::class);
        $collection->remove('foo');
    }
}
