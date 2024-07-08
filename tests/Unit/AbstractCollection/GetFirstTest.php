<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Exception\KeyNotFoundException;

final class GetFirstTest extends TestCase
{
    public function testCount0(): void
    {
        $collection = new Collection();

        $this->expectExceptionObject(new KeyNotFoundException('First key not found.'));
        $collection->getFirst();
    }

    public function testIndexed(): void
    {
        $collection = new Collection(['foo', 'bar']);

        static::assertSame('foo', $collection->getFirst());
    }

    public function testAssociative(): void
    {
        $collection = new Collection(['foo' => 'bar', 'baz' => 'qux']);

        static::assertSame('bar', $collection->getFirst());
    }
}
