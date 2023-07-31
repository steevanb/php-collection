<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

/** @covers \Steevanb\PhpCollection\AbstractCollection::toArray */
final class ToArrayTest extends TestCase
{
    public function testToArray(): void
    {
        $data = [0 => 1, 1 => '2', 2 => null, 'foo' => 'foo'];
        $collection = new TestCollection($data);

        static::assertSame($data, $collection->toArray());
    }
}
