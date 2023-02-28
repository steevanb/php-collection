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

        static::assertSame(1, $collection->callDoGet(0));
        static::assertSame('2', $collection->callDoGet(1));
        static::assertNull($collection->callDoGet(2));
    }

    public function testKeyNotFound(): void
    {
        $collection = new Collection([1, '2', null]);

        static::expectException(KeyNotFoundException::class);
        static::assertFalse($collection->callDoGet(3));
    }
}
