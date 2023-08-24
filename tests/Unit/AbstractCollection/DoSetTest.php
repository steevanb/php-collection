<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

final class DoSetTest extends TestCase
{
    public function testSetIntegerKeys(): void
    {
        $collection = new Collection();
        $collection->set(0, 1);
        $collection->set(1, '2');
        $collection->set(2, null);

        static::assertSame(1, $collection->get(0));
        static::assertSame('2', $collection->get(1));
        static::assertNull($collection->get(2));
    }

    public function testSetStringKeys(): void
    {
        $collection = new Collection();
        $collection->set('foo', 1);
        $collection->set('bar', '2');
        $collection->set('baz', null);

        static::assertSame(1, $collection->get('foo'));
        static::assertSame('2', $collection->get('bar'));
        static::assertNull($collection->get('baz'));
    }
}
