<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Bridge\Symfony\Normalizer\ObjectCollectionDenormalizer;
use Symfony\Component\Serializer\{
    Normalizer\ObjectNormalizer,
    Serializer
};

final class DataCollectionDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ObjectCollectionDenormalizer(), new ObjectNormalizer()]);
        /** @var DataCollection $collection */
        $collection = $serializer->denormalize(
            [
                ['foo' => 'foo1', 'bar' => 42],
                ['foo' => 'foo2', 'bar' => 43]
            ],
            DataCollection::class
        );

        static::assertCount(2, $collection);

        $data1 = $collection->callDoGet(0);
        static::assertInstanceOf(Data::class, $data1);
        static::assertSame('foo1', $data1->foo);
        static::assertSame(42, $data1->bar);

        $data2 = $collection->callDoGet(1);
        static::assertInstanceOf(Data::class, $data2);
        static::assertSame('foo2', $data2->foo);
        static::assertSame(43, $data2->bar);
    }

    public function testDenormalizeNullable(): void
    {
        $serializer = new Serializer([new ObjectCollectionDenormalizer(), new ObjectNormalizer()]);
        /** @var DataNullableCollection $collection */
        $collection = $serializer->denormalize(
            [
                ['foo' => 'foo1', 'bar' => 42],
                ['foo' => 'foo2', 'bar' => 43],
                null
            ],
            DataNullableCollection::class
        );

        static::assertCount(3, $collection);

        $data1 = $collection->callDoGet(0);
        static::assertInstanceOf(Data::class, $data1);
        static::assertSame('foo1', $data1->foo);
        static::assertSame(42, $data1->bar);

        $data2 = $collection->callDoGet(1);
        static::assertInstanceOf(Data::class, $data2);
        static::assertSame('foo2', $data2->foo);
        static::assertSame(43, $data2->bar);

        static::assertNull($collection->callDoGet(2));
    }
}
