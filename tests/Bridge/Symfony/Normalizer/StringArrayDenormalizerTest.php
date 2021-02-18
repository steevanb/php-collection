<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Bridge\Symfony\Normalizer;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Bridge\Symfony\Normalizer\ScalarArrayDenormalizer,
    ScalarArray\StringArray
};
use Symfony\Component\Serializer\Serializer;

final class StringArrayDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ScalarArrayDenormalizer()]);
        /** @var StringArray $array */
        $array = $serializer->denormalize(['string1', 'string2'], StringArray::class);

        static::assertCount(2, $array);
        static::assertSame('string1', $array[0]);
        static::assertSame('string2', $array[1]);
    }
}
