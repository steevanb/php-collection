<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTimeImmutableCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableCollection;

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableCollection::contains
 * @internal
 */
final class ContainsTest extends TestCase
{
    public function testContains(): void
    {
        $dateTimeImmutableA = new \DateTimeImmutable();
        $dateTimeImmutableCopy = $dateTimeImmutableA;
        $dateTimeImmutableB = new \DateTimeImmutable();
        $dateTimeImmutableClone = clone $dateTimeImmutableA;
        $dateTimeImmutableSameTime = (new \DateTimeImmutable())->setTimestamp($dateTimeImmutableA->getTimestamp());

        $dateTimeImmutableCollection = new DateTimeImmutableCollection([$dateTimeImmutableA]);

        static::assertTrue($dateTimeImmutableCollection->contains($dateTimeImmutableA));
        static::assertTrue($dateTimeImmutableCollection->contains($dateTimeImmutableCopy));
        static::assertFalse($dateTimeImmutableCollection->contains($dateTimeImmutableB));
        static::assertFalse($dateTimeImmutableCollection->contains($dateTimeImmutableClone));
        static::assertFalse($dateTimeImmutableCollection->contains($dateTimeImmutableSameTime));
    }

    public function testContainsAfterClone(): void
    {
        $dateTimeImmutable = new \DateTimeImmutable();

        $dateTimeImmutableCollection = (new DateTimeImmutableCollection([$dateTimeImmutable]));
        $dateTimeImmutableCollectionClone = clone ($dateTimeImmutableCollection);

        static::assertTrue($dateTimeImmutableCollection->contains($dateTimeImmutable));
        static::assertTrue($dateTimeImmutableCollectionClone->contains($dateTimeImmutable));
    }

    public function testContainsAfterMerge(): void
    {
        $dateTimeImmutable = new \DateTimeImmutable();

        static::assertTrue(
            (new DateTimeImmutableCollection([$dateTimeImmutable]))
                ->merge(new DateTimeImmutableCollection([new \DateTimeImmutable()]))
                ->contains($dateTimeImmutable)
        );
    }
}
