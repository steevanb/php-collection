<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTimeNullableCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\ObjectCollection\DateTimeNullableCollection;

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTimeNullableCollection::contains
 * @internal
 */
final class ContainsTest extends TestCase
{
    public function testContains(): void
    {
        $dateTimeA = new \DateTime();
        $dateTimeCopy = $dateTimeA;
        $dateTimeB = new \DateTime();
        $dateTimeClone = clone $dateTimeA;
        $dateTimeSameTime = (new \DateTime())->setTimestamp($dateTimeA->getTimestamp());

        $dateTimeNullableCollection = new DateTimeNullableCollection([$dateTimeA, null]);

        static::assertTrue($dateTimeNullableCollection->contains($dateTimeA));
        static::assertTrue($dateTimeNullableCollection->contains($dateTimeCopy));
        static::assertFalse($dateTimeNullableCollection->contains($dateTimeB));
        static::assertFalse($dateTimeNullableCollection->contains($dateTimeClone));
        static::assertFalse($dateTimeNullableCollection->contains($dateTimeSameTime));
        static::assertTrue($dateTimeNullableCollection->contains(null));
    }

    public function testContainsAfterClone(): void
    {
        $dateTime = new \DateTime();

        $dateTimeNullableCollection = (new DateTimeNullableCollection([$dateTime]));
        $dateTimeNullableCollectionClone = clone ($dateTimeNullableCollection);

        static::assertTrue($dateTimeNullableCollection->contains($dateTime));
        static::assertTrue($dateTimeNullableCollectionClone->contains($dateTime));
    }

    public function testContainsAfterMerge(): void
    {
        $dateTime = new \DateTime();

        static::assertTrue(
            (new DateTimeNullableCollection([$dateTime]))
                ->merge(new DateTimeNullableCollection([new \DateTime()]))
                ->contains($dateTime)
        );
    }
}
