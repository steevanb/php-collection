<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Bridge\Symfony\Normalizer;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Bridge\Symfony\Normalizer\ScalarArrayDenormalizer,
    ScalarArray\FloatArray,
    ScalarArray\IntArray,
    ScalarArray\StringArray
};
use Symfony\Component\Serializer\Serializer;

final class ScalarArrayDenormalizerTest extends TestCase
{
    public function testDenormalizeFloatArray(): void
    {
        $serializer = new Serializer([new ScalarArrayDenormalizer()]);
        $array = $serializer->denormalize([1.1, 2.2, 3.3], FloatArray::class);

        static::assertCount(3, $array);
        static::assertSame(1.1, $array[0]);
        static::assertSame(2.2, $array[1]);
        static::assertSame(3.3, $array[2]);
    }

    public function testDenormalizeIntArray(): void
    {
        $serializer = new Serializer([new ScalarArrayDenormalizer()]);
        $array = $serializer->denormalize([1, 2, 3], IntArray::class);

        static::assertCount(3, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2, $array[1]);
        static::assertSame(3, $array[2]);
    }

    public function testDenormalizeStringArray(): void
    {
        $serializer = new Serializer([new ScalarArrayDenormalizer()]);
        $array = $serializer->denormalize(['1', '2', '3'], StringArray::class);

        static::assertCount(3, $array);
        static::assertSame('1', $array[0]);
        static::assertSame('2', $array[1]);
        static::assertSame('3', $array[2]);
    }
}
