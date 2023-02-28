<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer,
    ScalarCollection\IntCollection
};
use Symfony\Component\Serializer\Serializer;

final class IntCollectionDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ScalarCollectionDenormalizer()]);
        /** @var IntCollection $collection */
        $collection = $serializer->denormalize([1, 2], IntCollection::class);

        static::assertCount(2, $collection);
        static::assertSame(1, $collection[0]);
        static::assertSame(2, $collection[1]);
    }
}
