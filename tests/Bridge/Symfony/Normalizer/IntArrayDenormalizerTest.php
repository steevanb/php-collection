<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Bridge\Symfony\Normalizer;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Bridge\Symfony\Normalizer\ScalarArrayDenormalizer,
    ScalarArray\IntArray
};
use Symfony\Component\Serializer\Serializer;

final class IntArrayDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ScalarArrayDenormalizer()]);
        /** @var IntArray $array */
        $array = $serializer->denormalize([1, 2], IntArray::class);

        static::assertCount(2, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
    }
}
