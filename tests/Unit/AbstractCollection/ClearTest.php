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

        $collection->clear();

        static::assertCount(0, $collection);

        $collection->add(1);

        static::assertCount(1, $collection);
    }

    public function testOneItem(): void
    {
        $collection = new Collection([1]);

        static::assertCount(1, $collection);

        $collection->clear();

        static::assertCount(0, $collection);

        $collection->add(2);

        static::assertCount(1, $collection);
    }

    public function testThreeItem(): void
    {
        $collection = new Collection([1, 2, 3]);

        static::assertCount(3, $collection);

        $collection->clear();

        static::assertCount(0, $collection);

        $collection->add(4);

        static::assertCount(1, $collection);
    }
}
