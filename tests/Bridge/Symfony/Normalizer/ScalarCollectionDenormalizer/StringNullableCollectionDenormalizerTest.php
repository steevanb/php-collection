<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer,
    ScalarCollection\StringNullableCollection
};
use Symfony\Component\Serializer\Serializer;

final class StringNullableCollectionDenormalizerTest extends TestCase
{
    /**
     * @covers \Steevanb\PhpCollection\Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer::supportsDenormalization
     * @covers \Steevanb\PhpCollection\Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer::denormalize
     * @covers \Steevanb\PhpCollection\Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer::createScalarCollection
     */
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ScalarCollectionDenormalizer()]);
        /** @var StringNullableCollection $collection */
        $collection = $serializer->denormalize(['string1', 'string2', null], StringNullableCollection::class);

        static::assertCount(3, $collection);
        static::assertSame('string1', $collection->get(0));
        static::assertSame('string2', $collection->get(1));
        static::assertNull($collection->get(2));
    }
}
