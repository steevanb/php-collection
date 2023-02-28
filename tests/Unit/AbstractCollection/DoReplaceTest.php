<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

final class DoReplaceTest extends TestCase
{
    public function testConstructorValues(): void
    {
        $collection = new Collection([10, 11, 12, 13]);

        static::assertCount(4, $collection);
        static::assertSame(10, $collection->callDoGet(0));
        static::assertSame(11, $collection->callDoGet(1));
        static::assertSame(12, $collection->callDoGet(2));
        static::assertSame(13, $collection->callDoGet(3));
    }

    public function testReplace(): void
    {
        $collection = (new Collection())
            ->callDoReplace([10, 11, 12, 13]);

        static::assertCount(4, $collection);
        static::assertSame(10, $collection->callDoGet(0));
        static::assertSame(11, $collection->callDoGet(1));
        static::assertSame(12, $collection->callDoGet(2));
        static::assertSame(13, $collection->callDoGet(3));
    }
}
