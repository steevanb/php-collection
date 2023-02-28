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

    public function testSetValues(): void
    {
        $collection = new Collection([1, 2]);
        $collection->setValues([3, 4]);

        static::addToAssertionCount(1);
    }

    public function testAddValue(): void
    {
        $collection = new Collection([1, 2]);
        $collection[] = 3;

        static::addToAssertionCount(1);
    }

    public function testOffsetSet(): void
    {
        $collection = new Collection([1, 2]);
        $collection->offsetSet(0, 4);

        static::addToAssertionCount(1);
    }

    public function testOffsetUnset(): void
    {
        $collection = new Collection([1, 2]);
        $collection->offsetUnset(0);

        static::addToAssertionCount(1);
    }

    public function testResetKeys(): void
    {
        $collection = new Collection([1, 2]);
        $collection->resetKeys();

        static::addToAssertionCount(1);
    }

    public function testReadOnlySetValues(): void
    {
        $collection = (new Collection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $collection->setValues([3, 4]);
    }

    public function testReadOnlyAddValue(): void
    {
        $collection = (new Collection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $collection[] = 3;
    }

    public function testReadOnlyOffsetSet(): void
    {
        $collection = (new Collection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $collection->offsetSet(0, 4);
    }

    public function testReadOnlyOffsetUnset(): void
    {
        $collection = (new Collection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $collection->offsetUnset(0);
    }

    public function testReadOnlyResetKeys(): void
    {
        $collection = (new Collection([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $collection->resetKeys();
    }
}
