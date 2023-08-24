<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\ValueAlreadyExistsException,
    ValueAlreadyExistsModeEnum
};

final class ValudAlreadyExistsTest extends TestCase
{
    public function testDefault(): void
    {
        $collection = new Collection([10, 11, 11, 13]);

        static::assertCount(4, $collection);
        static::assertSame(10, $collection->get(0));
        static::assertSame(11, $collection->get(1));
        static::assertSame(11, $collection->get(2));
        static::assertSame(13, $collection->get(3));
    }

    public function testDoNotAdd(): void
    {
        $collection = new Collection([10, 11, 11, 13], ValueAlreadyExistsModeEnum::DO_NOT_ADD);

        static::assertCount(3, $collection);
        static::assertSame(10, $collection->get(0));
        static::assertSame(11, $collection->get(1));
        static::assertSame(13, $collection->get(3));
    }

    public function testDoNotAdd2(): void
    {
        $collection = new Collection([], ValueAlreadyExistsModeEnum::DO_NOT_ADD);
        $collection
            ->add(10)
            ->add(11)
            ->add(11)
            ->add(13);

        static::assertCount(3, $collection);
        static::assertSame(10, $collection->get(0));
        static::assertSame(11, $collection->get(1));
        static::assertSame(13, $collection->get(2));
    }

    public function testException(): void
    {
        static::expectException(ValueAlreadyExistsException::class);
        new Collection([10, 11, 11, 13], ValueAlreadyExistsModeEnum::EXCEPTION);
    }
}
