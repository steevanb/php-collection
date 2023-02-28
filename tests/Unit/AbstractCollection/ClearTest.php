<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

final class ClearTest extends TestCase
{
    public function testEmpty(): void
    {
        $collection = new Collection();

        static::assertCount(0, $collection);
        static::assertSame(0, $collection->getNextIntKey());

        $collection->clear();

        static::assertCount(0, $collection);
        static::assertSame(0, $collection->getNextIntKey());

        $collection[] = 1;

        static::assertCount(1, $collection);
        static::assertSame(1, $collection->getNextIntKey());
    }

    public function testOneItem(): void
    {
        $collection = new Collection([1]);

        static::assertCount(1, $collection);
        static::assertSame(1, $collection->getNextIntKey());

        $collection->clear();

        static::assertCount(0, $collection);
        static::assertSame(0, $collection->getNextIntKey());

        $collection[] = 2;

        static::assertCount(1, $collection);
        static::assertSame(1, $collection->getNextIntKey());
    }

    public function testThreeItem(): void
    {
        $collection = new Collection([1, 2, 3]);

        static::assertCount(3, $collection);
        static::assertSame(3, $collection->getNextIntKey());

        $collection->clear();

        static::assertCount(0, $collection);
        static::assertSame(0, $collection->getNextIntKey());

        $collection[] = 4;

        static::assertCount(1, $collection);
        static::assertSame(1, $collection->getNextIntKey());
    }
}
