<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTimeCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\ObjectCollection\DateTimeCollection;

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTimeCollection::contains
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

        $dateTimeCollection = new DateTimeCollection([$dateTimeA]);

        static::assertTrue($dateTimeCollection->contains($dateTimeA));
        static::assertTrue($dateTimeCollection->contains($dateTimeCopy));
        static::assertFalse($dateTimeCollection->contains($dateTimeB));
        static::assertFalse($dateTimeCollection->contains($dateTimeClone));
        static::assertFalse($dateTimeCollection->contains($dateTimeSameTime));
    }

    public function testContainsAfterClone(): void
    {
        $dateTime = new \DateTime();

        $dateTimeCollection = (new DateTimeCollection([$dateTime]));
        $dateTimeCollectionClone = clone ($dateTimeCollection);

        static::assertTrue($dateTimeCollection->contains($dateTime));
        static::assertTrue($dateTimeCollectionClone->contains($dateTime));
    }

    public function testContainsAfterMerge(): void
    {
        $dateTime = new \DateTime();

        static::assertTrue(
            (new DateTimeCollection([$dateTime]))
                ->merge(new DateTimeCollection([new \DateTime()]))
                ->contains($dateTime)
        );
    }
}
