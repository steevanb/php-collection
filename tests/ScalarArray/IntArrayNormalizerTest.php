<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ScalarArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Bridge\Symfony\Normalizer\ScalarArray\IntArrayDenormalizer,
    ScalarArray\IntArray
};
use Symfony\Component\Serializer\Serializer;

final class IntArrayNormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new IntArrayDenormalizer()]);
        /** @var IntArray $array */
        $array = $serializer->denormalize([1, 2], IntArray::class);

        static::assertCount(2, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
    }
}
