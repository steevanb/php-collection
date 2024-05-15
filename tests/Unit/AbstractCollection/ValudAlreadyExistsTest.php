<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

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
}
