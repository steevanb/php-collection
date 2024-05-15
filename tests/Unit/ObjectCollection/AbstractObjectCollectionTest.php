<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Exception\InvalidTypeException;

final class AbstractObjectCollectionTest extends TestCase
{
    public function testConstructor(): void
    {
        $collection = new TestObjectCollection();

        static::assertCount(0, $collection);
    }

    public function testAssertValueType(): void
    {
        $collection = new TestObjectCollection(
            [
                new TestObject('foo'),
                new TestObject('bar')
            ]
        );

        static::assertSame('foo', $collection->get(0)->getValue());
        static::assertSame('bar', $collection->get(1)->getValue());
    }

    public function testAssertValueTypeInvalidInstanceOf(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Value should be an instance of Steevanb\PhpCollection\Tests\Unit\ObjectCollection\TestObject, '
            . 'stdClass given.'
        );
        /** @phpstan-ignore-next-line Parameter #1 $values ... constructor expects ... array<int, stdClass> given. */
        new TestObjectCollection([new \stdClass()]);
    }

    public function testAssertValueTypeInvalidValueNull(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Value should be an instance of Steevanb\PhpCollection\Tests\Unit\ObjectCollection\TestObject, '
            . 'null given.'
        );
        /** @phpstan-ignore-next-line Parameter #1 $values ... constructor expects ... array<int, null> given. */
        new TestObjectCollection([null]);
    }

    public function testNotContains(): void
    {
        $object1 = new TestObject('value 1');
        $object2 = new TestObject('value 2');
        $object3 = new TestObject('value 3');
        $collection = new TestObjectCollection([$object1, $object2]);

        static::assertFalse($collection->contains($object3));
    }

    public function testContainsEquals(): void
    {
        $object1 = new TestObject('value 1');
        $object2 = new TestObject('value 2');
        $object3 = new TestObject('value 1');
        $collection = new TestObjectCollection([$object1, $object2]);

        static::assertFalse($collection->contains($object3));
    }

    public function testContainsSame(): void
    {
        $object1 = new TestObject('value 1');
        $object2 = new TestObject('value 2');
        $collection = new TestObjectCollection([$object1, $object2]);

        static::assertTrue($collection->contains($object2));
    }
}
