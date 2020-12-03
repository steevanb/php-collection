<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ScalarArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Bridge\Symfony\Normalizer\ScalarArray\BoolArrayDenormalizer,
    ScalarArray\BoolArray
};
use Symfony\Component\Serializer\Serializer;

final class BoolArrayNormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new BoolArrayDenormalizer()]);
        /** @var BoolArray $array */
        $array = $serializer->denormalize([true, false], BoolArray::class);

        static::assertCount(2, $array);
        static::assertSame(true, $array[0]);
        static::assertSame(false, $array[1]);
    }
}
