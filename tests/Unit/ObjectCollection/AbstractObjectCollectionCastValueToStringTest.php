<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\PhpCollectionException,
    ObjectCollection\AbstractObjectCollection
};

final class AbstractObjectCollectionCastValueToStringTest extends TestCase
{
    public function testStdClass(): void
    {
        $collection = new class extends AbstractObjectCollection
        {
            public static function getValueFqcn(): string
            {
                return TestStringEnum::class;
            }

            public function callCastValueToString(): string
            {
                return $this->castValueToString(new \stdClass());
            }
        };

        $this->expectException(PhpCollectionException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage(
            'Error while converting an instance of stdClass to string. Add __toString() to do it.'
        );
        $collection->callCastValueToString();
    }

    public function testStringable(): void
    {
        $collection = new class extends AbstractObjectCollection
        {
            public static function getValueFqcn(): string
            {
                return \stdClass::class;
            }

            public function callCastValueToString(): string
            {
                return $this->castValueToString(
                    new class {
                        public function __toString(): string
                        {
                            return 'foo';
                        }
                    }
                );
            }
        };

        static::assertSame('foo', $collection->callCastValueToString());
    }

    public function testUnitEnum(): void
    {
        $collection = new class extends AbstractObjectCollection
        {
            public static function getValueFqcn(): string
            {
                return TestEnum::class;
            }

            public function callCastValueToString(): string
            {
                return $this->castValueToString(TestEnum::VALUE1);
            }
        };

        static::assertSame('VALUE1', $collection->callCastValueToString());
    }

    public function testStringEnum(): void
    {
        $collection = new class extends AbstractObjectCollection
        {
            public static function getValueFqcn(): string
            {
                return TestStringEnum::class;
            }

            public function callCastValueToString(): string
            {
                return $this->castValueToString(TestStringEnum::VALUE1);
            }
        };

        static::assertSame('VALUE-1', $collection->callCastValueToString());
    }

    public function testIntEnum(): void
    {
        $collection = new class extends AbstractObjectCollection
        {
            public static function getValueFqcn(): string
            {
                return TestIntEnum::class;
            }

            public function callCastValueToString(): string
            {
                return $this->castValueToString(TestIntEnum::VALUE1);
            }
        };

        static::assertSame('1', $collection->callCastValueToString());
    }
}
