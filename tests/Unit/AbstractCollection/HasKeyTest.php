<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

final class HasKeyTest extends TestCase
{
    public function testHasStringKey(): void
    {
        $collection = new Collection(['foo' => 1, 'bar' => '2', 'baz' => null]);

        static::assertTrue($collection->hasKey('foo'));
        static::assertTrue($collection->hasKey('bar'));
        static::assertTrue($collection->hasKey('baz'));
    }

    public function testHasIntegerKey(): void
    {
        $collection = new Collection([0 => 1, 1 => '2', 3 => null]);

        static::assertTrue($collection->hasKey(0));
        static::assertTrue($collection->hasKey(1));
        static::assertTrue($collection->hasKey(3));
    }

    public function testDoNotHaveKey(): void
    {
        $collection = new Collection([0 => 1, 1 => '2', 3 => null]);

        static::assertFalse($collection->hasKey(2));
        static::assertFalse($collection->hasKey(4));
    }
}
