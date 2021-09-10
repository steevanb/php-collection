<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use PHPUnit\Framework\TestCase;

final class CountableTest extends TestCase
{
    public function testCount(): void
    {
        static::assertCount(3, new TypedArray([1, '2', null]));
    }
}
