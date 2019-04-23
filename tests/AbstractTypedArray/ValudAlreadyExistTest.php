<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\AbstractTypedArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\Exception\ValueAlreadyExistException;

final class ValudAlreadyExistTest extends TestCase
{
    public function testValueAlreadyExistModeAdd(): void
    {
        $array = new TypedArray([10, 11, 11, 13]);

        static::assertCount(4, $array);
        static::assertSame(10, $array[0]);
        static::assertSame(11, $array[1]);
        static::assertSame(11, $array[2]);
        static::assertSame(13, $array[3]);
    }

    public function testValueAlreadyExistModeDoNotAdd(): void
    {
        $array = (new TypedArray())
            ->setValueAlreadyExistMode(TypedArray::VALUE_ALREADY_EXIST_DO_NOT_ADD)
            ->setValues([10, 11, 11, 13]);

        static::assertCount(3, $array);
        static::assertSame(10, $array[0]);
        static::assertSame(11, $array[1]);
        static::assertSame(13, $array[3]);
    }

    public function testValueAlreadyExistModeException(): void
    {
        static::expectException(ValueAlreadyExistException::class);

        (new TypedArray())
            ->setValueAlreadyExistMode(TypedArray::VALUE_ALREADY_EXIST_EXCEPTION)
            ->setValues([10, 11, 11, 13]);
    }
}
