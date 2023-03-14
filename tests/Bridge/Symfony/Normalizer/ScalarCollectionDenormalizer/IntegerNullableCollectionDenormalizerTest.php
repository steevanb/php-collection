<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer,
    ScalarCollection\IntegerNullableCollection
};
use Symfony\Component\Serializer\Serializer;

final class IntegerNullableCollectionDenormalizerTest extends TestCase
{
    /**
     * @covers \Steevanb\PhpCollection\Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer::supportsDenormalization
     * @covers \Steevanb\PhpCollection\Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer::denormalize
     * @covers \Steevanb\PhpCollection\Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer::createScalarCollection
     */
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ScalarCollectionDenormalizer()]);
        /** @var IntegerNullableCollection $collection */
        $collection = $serializer->denormalize([1, 2, null], IntegerNullableCollection::class);

        static::assertCount(3, $collection);
        static::assertSame(1, $collection->get(0));
        static::assertSame(2, $collection->get(1));
        static::assertNull($collection->get(2));
    }
}
