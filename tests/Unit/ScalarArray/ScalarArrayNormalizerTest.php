<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Unit\ScalarArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Bridge\Symfony\Normalizer\ScalarArray\ScalarArrayDenormalizer,
    ScalarArray\ScalarArray
};
use Symfony\Component\Serializer\Serializer;

final class ScalarArrayNormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ScalarArrayDenormalizer()]);
        /** @var ScalarArray $array */
        $array = $serializer->denormalize([1, 2.0, 3.1, '4', true, false], ScalarArray::class);

        static::assertCount(6, $array);
        static::assertSame(1, $array[0]);
        static::assertSame(2.0, $array[1]);
        static::assertSame(3.1, $array[2]);
        static::assertSame('4', $array[3]);
        static::assertSame(true, $array[4]);
        static::assertSame(false, $array[5]);
    }
}
