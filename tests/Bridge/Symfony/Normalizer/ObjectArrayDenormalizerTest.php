<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Bridge\Symfony\Normalizer;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Bridge\Symfony\Normalizer\ObjectArrayDenormalizer,
    ObjectArray\ObjectArray,
    ScalarArray\BoolArray
};
use Symfony\Component\Serializer\{
    Normalizer\ObjectNormalizer,
    Serializer
};

final class ObjectArrayDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $serializer = new Serializer([new ObjectArrayDenormalizer(), new ObjectNormalizer()]);
        /** @var BoolArray $array */
        $array = $serializer->denormalize(
            new ObjectArray(
                [
                    new TestObject('foo', 42),
                    new TestObject('bar', 43)
                ],
                TestObject::class
            ),
            ObjectArray::class
        );

        static::assertCount(2, $array);

        /** @var TestObject $testObject1 */
        $testObject1 = $array[0];
        static::assertSame('foo', $testObject1->foo);
        static::assertSame(42, $testObject1->bar);

        /** @var TestObject $testObject2 */
        $testObject2 = $array[1];
        static::assertSame('bar', $testObject2->foo);
        static::assertSame(43, $testObject2->bar);
    }
}
