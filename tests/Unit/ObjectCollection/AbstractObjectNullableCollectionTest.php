<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Exception\InvalidTypeException;

final class AbstractObjectNullableCollectionTest extends TestCase
{
    public function testConstructor(): void
    {
        $collection = new TestObjectNullableCollection();

        static::assertCount(0, $collection);
    }

    public function testAssertValueType(): void
    {
        $collection = new TestObjectNullableCollection(
            [
                new TestObject('foo'),
                new TestObject('bar')
            ]
        );

        static::assertInstanceOf(TestObject::class, $collection->get(0));
        static::assertSame('foo', $collection->get(0)->getValue());
        static::assertInstanceOf(TestObject::class, $collection->get(1));
        static::assertSame('bar', $collection->get(1)->getValue());
    }

    public function testAssertValueTypeInvalidInstanceOf(): void
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Value should be an instance of Steevanb\PhpCollection\Tests\Unit\ObjectCollection\TestObject or NULL, '
            . 'stdClass given.'
        );
        /** @phpstan-ignore-next-line Parameter #1 $values ... constructor expects ... array<int, stdClass> given. */
        new TestObjectNullableCollection([new \stdClass()]);
        $this->addToAssertionCount(1);
    }

    public function testAssertValueTypeNull(): void
    {
        $collection = new TestObjectNullableCollection([null]);

        static::assertNull($collection->get(0));
    }

    public function testNotContains(): void
    {
        $object1 = new TestObject('value 1');
        $object2 = new TestObject('value 2');
        $object3 = new TestObject('value 3');
        $collection = new TestObjectNullableCollection([$object1, $object2]);

        static::assertFalse($collection->contains($object3));
    }

    public function testContainsEquals(): void
    {
        $object1 = new TestObject('value 1');
        $object2 = new TestObject('value 2');
        $object3 = new TestObject('value 1');
        $collection = new TestObjectNullableCollection([$object1, $object2]);

        static::assertFalse($collection->contains($object3));
    }

    public function testContainsSame(): void
    {
        $object1 = new TestObject('value 1');
        $object2 = new TestObject('value 2');
        $collection = new TestObjectNullableCollection([$object1, $object2]);

        static::assertTrue($collection->contains($object2));
    }

    public function testContainsNull(): void
    {
        $object1 = new TestObject('value 1');
        $object2 = new TestObject('value 2');
        $collection = new TestObjectNullableCollection([$object1, $object2, null]);

        static::assertTrue($collection->contains(null));
    }
}
