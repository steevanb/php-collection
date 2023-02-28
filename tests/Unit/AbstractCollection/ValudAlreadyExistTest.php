<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\ValueAlreadyExistsException,
    ValueAlreadyExistsModeEnum
};

final class ValudAlreadyExistTest extends TestCase
{
    public function testValueAlreadyExistsModeAdd(): void
    {
        $collection = new Collection([10, 11, 11, 13]);

        static::assertCount(4, $collection);
        static::assertSame(10, $collection->callDoGet(0));
        static::assertSame(11, $collection->callDoGet(1));
        static::assertSame(11, $collection->callDoGet(2));
        static::assertSame(13, $collection->callDoGet(3));
    }

    public function testValueAlreadyExistsModeDoNotAdd(): void
    {
        $collection = new Collection([10, 11, 11, 13], ValueAlreadyExistsModeEnum::DO_NOT_ADD);

        static::assertCount(3, $collection);
        static::assertSame(10, $collection->callDoGet(0));
        static::assertSame(11, $collection->callDoGet(1));
        static::assertSame(13, $collection->callDoGet(3));
    }

    public function testValueAlreadyExistsModeException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        new Collection([10, 11, 11, 13], ValueAlreadyExistsModeEnum::EXCEPTION);
    }
}
