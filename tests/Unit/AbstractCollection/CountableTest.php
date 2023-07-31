<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

/** @coversNothing */
final class CountableTest extends TestCase
{
    public function testCount(): void
    {
        static::assertCount(3, new TestCollection([1, '2', null]));
    }
}
