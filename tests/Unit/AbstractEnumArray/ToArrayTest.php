<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\AbstractEnumArray;

use PHPUnit\Framework\TestCase;

final class ToArrayTest extends TestCase
{
    public function testEmpty(): void
    {
        $array = (new TestAbstractEnumArray())->toArray();

        static::assertCount(0, $array);
    }

    public function testOneValue(): void
    {
        $array = (new TestAbstractEnumArray([TestEnum::VALUE1]))->toArray();

        static::assertCount(1, $array);
        static::assertArrayHasKey(0, $array);
        static::assertSame($array[0], TestEnum::VALUE1);
    }

    public function testThreeValue(): void
    {
        $array = (
            new TestAbstractEnumArray(
                [TestEnum::VALUE1, TestEnum::VALUE2, TestEnum::VALUE3]
            )
        )->toArray();

        static::assertCount(3, $array);
        static::assertArrayHasKey(0, $array);
        static::assertSame($array[0], TestEnum::VALUE1);
        static::assertArrayHasKey(1, $array);
        static::assertSame($array[1], TestEnum::VALUE2);
        static::assertArrayHasKey(2, $array);
        static::assertSame($array[2], TestEnum::VALUE3);
    }
}
