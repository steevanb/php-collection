<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Exception\KeyNotFoundException;

final class DoGetTest extends TestCase
{
    public function testGet(): void
    {
        $collection = new Collection([1, '2', null]);

        static::assertSame(1, $collection->get(0));
        static::assertSame('2', $collection->get(1));
        static::assertNull($collection->get(2));
    }

    public function testKeyNotFound(): void
    {
        $collection = new Collection([1, '2', null]);

        static::expectException(KeyNotFoundException::class);
        static::assertFalse($collection->get(3));
    }
}
