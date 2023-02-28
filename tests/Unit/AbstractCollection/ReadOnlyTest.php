<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Exception\ReadOnlyException;

final class ReadOnlyTest extends TestCase
{
    public function testDefaultReadOnlyValue(): void
    {
        static::assertFalse((new Collection())->isReadOnly());
    }

    public function testReplace(): void
    {
        $collection = new Collection([1, 2]);
        $collection->callDoReplace([3, 4]);

        static::addToAssertionCount(1);
    }

    public function testAddValue(): void
    {
        $collection = new Collection([1, 2]);
        $collection->callDoAdd(3);

        static::addToAssertionCount(1);
    }

    public function testSet(): void
    {
        $collection = new Collection([1, 2]);
        $collection->callDoSet(0, 4);

        static::assertSame(4, $collection->callDoGet(0));
    }

    public function testRemove(): void
    {
        $collection = new Collection([1, 2]);
        $collection->remove(0);

        static::assertFalse($collection->hasKey(0));
    }

    public function testResetKeys(): void
    {
        $collection = new Collection([1, 2]);
        $collection->resetKeys();

        static::addToAssertionCount(1);
    }

    public function testReadOnlyReplace(): void
    {
        $collection = (new Collection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $collection->callDoReplace([3, 4]);
    }

    public function testReadOnlyAddValue(): void
    {
        $collection = (new Collection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $collection->callDoAdd(3);
    }

    public function testReadOnlySet(): void
    {
        $collection = (new Collection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $collection->callDoSet(0, 4);
    }

    public function testReadOnlyRemove(): void
    {
        $collection = (new Collection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $collection->remove(0);
    }

    public function testReadOnlyResetKeys(): void
    {
        $collection = (new Collection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $collection->resetKeys();
    }
}
