<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\Exception\ReadOnlyException;

final class ReadOnlyTest extends TestCase
{
    public function testDefaultReadOnlyValue(): void
    {
        static::assertSame(false, (new TypedArray())->isReadOnly());
    }

    public function testSetValues(): void
    {
        $array = new TypedArray([1, 2]);
        $array->setValues([3, 4]);

        static::addToAssertionCount(1);
    }

    public function testAddValue(): void
    {
        $array = new TypedArray([1, 2]);
        $array[] = 3;

        static::addToAssertionCount(1);
    }

    public function testOffsetSet(): void
    {
        $array = new TypedArray([1, 2]);
        $array->offsetSet(0, 4);

        static::addToAssertionCount(1);
    }

    public function testOffsetUnset(): void
    {
        $array = new TypedArray([1, 2]);
        $array->offsetUnset(0);

        static::addToAssertionCount(1);
    }

    public function testResetKeys(): void
    {
        $array = new TypedArray([1, 2]);
        $array->resetKeys();

        static::addToAssertionCount(1);
    }

    public function testReadOnlySetValues(): void
    {
        $array = (new TypedArray([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $array->setValues([3, 4]);
    }

    public function testReadOnlyAddValue(): void
    {
        $array = (new TypedArray([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $array[] = 3;
    }

    public function testReadOnlyOffsetSet(): void
    {
        $array = (new TypedArray([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $array->offsetSet(0, 4);
    }

    public function testReadOnlyOffsetUnset(): void
    {
        $array = (new TypedArray([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $array->offsetUnset(0);
    }

    public function testReadOnlyResetKeys(): void
    {
        $array = (new TypedArray([1, 2]))->setReadOnly();

        $this->expectException(ReadOnlyException::class);
        $array->resetKeys();
    }
}
