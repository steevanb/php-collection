<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Bridge\Symfony\Normalizer;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Bridge\Symfony\Normalizer\ScalarArrayDenormalizer,
    ScalarArray\FloatArray
};
use Symfony\Component\Serializer\Serializer;

final class FloatArrayNormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ScalarArrayDenormalizer()]);
        /** @var FloatArray $array */
        $array = $serializer->denormalize([1.0, 2.2], FloatArray::class);

        static::assertCount(2, $array);
        static::assertSame(1.0, $array[0]);
        static::assertSame(2.2, $array[1]);
    }
}
