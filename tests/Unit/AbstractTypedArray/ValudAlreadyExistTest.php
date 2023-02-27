<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpTypedArray\{
    Exception\ValueAlreadyExistsException,
    ValueAlreadyExistsModeEnum
};

final class ValudAlreadyExistTest extends TestCase
{
    public function testValueAlreadyExistsModeAdd(): void
    {
        $array = new TypedArray([10, 11, 11, 13]);

        static::assertCount(4, $array);
        static::assertSame(10, $array[0]);
        static::assertSame(11, $array[1]);
        static::assertSame(11, $array[2]);
        static::assertSame(13, $array[3]);
    }

    public function testValueAlreadyExistsModeDoNotAdd(): void
    {
        $array = new TypedArray([10, 11, 11, 13], ValueAlreadyExistsModeEnum::DO_NOT_ADD);

        static::assertCount(3, $array);
        static::assertSame(10, $array[0]);
        static::assertSame(11, $array[1]);
        static::assertSame(13, $array[3]);
    }

    public function testValueAlreadyExistsModeException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        new TypedArray([10, 11, 11, 13], ValueAlreadyExistsModeEnum::EXCEPTION);
    }
}
