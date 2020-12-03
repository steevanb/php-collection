<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ScalarArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Bridge\Symfony\Normalizer\ScalarArray\StringArrayDenormalizer,
    ScalarArray\StringArray
};
use Symfony\Component\Serializer\Serializer;

final class StringArrayNormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new StringArrayDenormalizer()]);
        /** @var StringArray $array */
        $array = $serializer->denormalize(['string1', 'string2'], StringArray::class);

        static::assertCount(2, $array);
        static::assertSame('string1', $array[0]);
        static::assertSame('string2', $array[1]);
    }
}
