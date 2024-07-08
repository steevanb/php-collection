<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Exception\KeyNotFoundException;

final class GeLastTest extends TestCase
{
    public function testCount0(): void
    {
        $collection = new Collection();

        $this->expectExceptionObject(new KeyNotFoundException('Last key not found.'));
        $collection->getLast();
    }

    public function testIndexed(): void
    {
        $collection = new Collection(['foo', 'bar']);

        static::assertSame('bar', $collection->getLast());
    }

    public function testAssociative(): void
    {
        $collection = new Collection(['foo' => 'bar', 'baz' => 'qux']);

        static::assertSame('qux', $collection->getLast());
    }
}
