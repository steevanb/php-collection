<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\KeyCaseEnum;

final class ChangeKeyCaseTest extends TestCase
{
    public function testDefaultParameters(): void
    {
        $collection = new Collection(['foo' => 1]);

        $collection->changeKeyCase();

        static::assertCount(1, $collection);
        static::assertArrayHasKey('foo', $collection->toArray());
        static::assertSame(1, $collection->get('foo'));
    }

    public function testLowerCaseAssociativesKeys(): void
    {
        $collection = new Collection(['foo' => 1, 'BaR' => 2, 'BAZ' => 3]);

        $collection->changeKeyCase(KeyCaseEnum::LOWER);

        static::assertCount(3, $collection);
        static::assertSame(1, $collection->get('foo'));
        static::assertSame(2, $collection->get('bar'));
        static::assertSame(3, $collection->get('baz'));
    }

    public function testUpperCaseAssociativesKeys(): void
    {
        $collection = new Collection(['foo' => 1, 'BaR' => 2, 'BAZ' => 3]);

        $collection->changeKeyCase(KeyCaseEnum::UPPER);

        static::assertCount(3, $collection);
        static::assertSame(1, $collection->get('FOO'));
        static::assertSame(2, $collection->get('BAR'));
        static::assertSame(3, $collection->get('BAZ'));
    }

    public function testLowerCaseIndexedKeys(): void
    {
        $collection = new Collection([0 => 1, 10 => 2, 20 => 3]);

        $collection->changeKeyCase(KeyCaseEnum::LOWER);

        static::assertCount(3, $collection);
        static::assertSame(1, $collection->get(0));
        static::assertSame(2, $collection->get(10));
        static::assertSame(3, $collection->get(20));
    }

    public function testUpperCaseIndexedKeys(): void
    {
        $collection = new Collection([0 => 1, 10 => 2, 20 => 3]);

        $collection->changeKeyCase(KeyCaseEnum::UPPER);

        static::assertCount(3, $collection);
        static::assertSame(1, $collection->get(0));
        static::assertSame(2, $collection->get(10));
        static::assertSame(3, $collection->get(20));
    }

    public function testEmpty(): void
    {
        $collection = new Collection();

        static::assertCount(0, $collection);

        $collection->changeKeyCase();

        static::assertCount(0, $collection);
    }

    public function testReturnType(): void
    {
        $collection = new Collection();

        static::assertSame($collection, $collection->changeKeyCase());
    }
}
