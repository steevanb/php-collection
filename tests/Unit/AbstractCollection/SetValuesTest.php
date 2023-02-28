<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

final class SetValuesTest extends TestCase
{
    public function testConstructorValues(): void
    {
        $collection = new Collection([10, 11, 12, 13]);

        static::assertCount(4, $collection);
        static::assertSame(10, $collection[0]);
        static::assertSame(11, $collection[1]);
        static::assertSame(12, $collection[2]);
        static::assertSame(13, $collection[3]);
    }

    public function testSetValues(): void
    {
        $collection = (new Collection())
            ->setValues([10, 11, 12, 13]);

        static::assertCount(4, $collection);
        static::assertSame(10, $collection[0]);
        static::assertSame(11, $collection[1]);
        static::assertSame(12, $collection[2]);
        static::assertSame(13, $collection[3]);
    }
}
