<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\ScalarArray;

use PHPUnit\Framework\TestCase;
use steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    ScalarArray\StringArray
};

final class StringArrayTest extends TestCase
{
    public function testCastValues(): void
    {
        $array = (new StringArray())
            ->setCastValues(true)
            ->setValues([1, '2', null]);

        static::assertSame('1', $array[0]);
        static::assertSame('2', $array[1]);
        static::assertSame(null, $array[2]);
    }

    public function testDoNotCastValues(): void
    {
        static::expectException(InvalidTypeException::class);
        new StringArray([1, '2']);
    }
}
