<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer,
    ScalarCollection\FloatCollection
};
use Symfony\Component\Serializer\Serializer;

final class FloatCollectionDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ScalarCollectionDenormalizer()]);
        /** @var FloatCollection $collection */
        $collection = $serializer->denormalize([1.0, 2.2], FloatCollection::class);

        static::assertCount(2, $collection);
        static::assertSame(1.0, $collection[0]);
        static::assertSame(2.2, $collection[1]);
    }
}
