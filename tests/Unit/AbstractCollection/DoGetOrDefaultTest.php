<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

final class DoGetOrDefaultTest extends TestCase
{
    public function testGetExistingKey(): void
    {
        $collection = new Collection([1, 'two' => '2', null]);

        static::assertSame(expected: 1, actual: $collection->getOrDefault(key: 0, default: '--test_1--'));
        static::assertSame(expected: '2', actual: $collection->getOrDefault(key: 'two', default: '--test_2--'));
        static::assertNull(actual: $collection->getOrDefault(key: 1, default: '--test_3--'));
    }

    public function testGetNotExistingKey(): void
    {
        $collection = new Collection([1, 'two' => '2', null]);

        static::assertSame(expected: '--test_1--', actual: $collection->getOrDefault(key: 2, default: '--test_1--'));
    }
}
