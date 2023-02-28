<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer,
    ScalarCollection\StringCollection
};
use Symfony\Component\Serializer\Serializer;

final class StringCollectionDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ScalarCollectionDenormalizer()]);
        /** @var StringCollection $collection */
        $collection = $serializer->denormalize(['string1', 'string2'], StringCollection::class);

        static::assertCount(2, $collection);
        static::assertSame('string1', $collection[0]);
        static::assertSame('string2', $collection[1]);
    }
}
