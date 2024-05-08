<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTimeImmutableNullableCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableNullableCollection;

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableNullableCollection::contains
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

        $dateTimeImmutableNullableCollection = new DateTimeImmutableNullableCollection([$dateTimeImmutableA, null]);

        static::assertTrue($dateTimeImmutableNullableCollection->contains($dateTimeImmutableA));
        static::assertTrue($dateTimeImmutableNullableCollection->contains($dateTimeImmutableCopy));
        static::assertFalse($dateTimeImmutableNullableCollection->contains($dateTimeImmutableB));
        static::assertFalse($dateTimeImmutableNullableCollection->contains($dateTimeImmutableClone));
        static::assertFalse($dateTimeImmutableNullableCollection->contains($dateTimeImmutableSameTime));
        static::assertTrue($dateTimeImmutableNullableCollection->contains(null));
    }

    public function testContainsAfterClone(): void
    {
        $dateTimeImmutable = new \DateTimeImmutable();

        $dateTimeImmutableNullableCollection = (new DateTimeImmutableNullableCollection([$dateTimeImmutable]));
        $dateTimeImmutableNullableCollectionClone = clone ($dateTimeImmutableNullableCollection);

        static::assertTrue($dateTimeImmutableNullableCollection->contains($dateTimeImmutable));
        static::assertTrue($dateTimeImmutableNullableCollectionClone->contains($dateTimeImmutable));
    }

    public function testContainsAfterMerge(): void
    {
        $dateTimeImmutable = new \DateTimeImmutable();

        static::assertTrue(
            (new DateTimeImmutableNullableCollection([$dateTimeImmutable]))
                ->merge(new DateTimeImmutableNullableCollection([new \DateTimeImmutable()]))
                ->contains($dateTimeImmutable)
        );
    }
}
