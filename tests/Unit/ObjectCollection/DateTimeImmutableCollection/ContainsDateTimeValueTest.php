<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTimeImmutableCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableCollection;

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableCollection::containsDateTimeValue
 * @internal
 */
final class ContainsDateTimeValueTest extends TestCase
{
    public function testContainsDateTimeValue(): void
    {
        $dateTimeImmutableA = new \DateTimeImmutable();
        $dateTimeImmutableCopy = $dateTimeImmutableA;
        // Asserting different timestamps
        $dateTimeImmutableB = (new \DateTimeImmutable())->add(new \DateInterval('PT1S'));
        $dateTimeImmutableClone = clone $dateTimeImmutableA;
        $dateTimeImmutableSameTime = (new \DateTimeImmutable())->setTimestamp($dateTimeImmutableA->getTimestamp());

        $dateTimeImmutableCollection = new DateTimeImmutableCollection([$dateTimeImmutableA]);

        static::assertTrue($dateTimeImmutableCollection->containsDateTimeValue($dateTimeImmutableA));
        static::assertTrue($dateTimeImmutableCollection->containsDateTimeValue($dateTimeImmutableCopy));
        static::assertFalse($dateTimeImmutableCollection->containsDateTimeValue($dateTimeImmutableB));
        static::assertTrue($dateTimeImmutableCollection->containsDateTimeValue($dateTimeImmutableClone));
        static::assertTrue($dateTimeImmutableCollection->containsDateTimeValue($dateTimeImmutableSameTime));
    }

    public function testContainsDateTimeValueWithTimezone(): void
    {
        $dateTimeImmutable = new \DateTimeImmutable('2024-07-14 12:00:00');
        $dateTimeImmutableB = clone $dateTimeImmutable;
        $dateTimeImmutableC = clone $dateTimeImmutable;
        $dateTimeImmutableD = clone $dateTimeImmutable;

        // Setting timezones
        $dateTimeImmutable = $dateTimeImmutable->setTimezone(new \DateTimeZone('+0800'));
        $dateTimeImmutableB = $dateTimeImmutableB->setTimezone(new \DateTimeZone('+0600'));
        $dateTimeImmutableC = $dateTimeImmutableC->setTimezone(new \DateTimeZone('-0600'));
        $dateTimeImmutableD = $dateTimeImmutableD->setTimezone($dateTimeImmutable->getTimezone());

        $dateTimeImmutableCollection = new DateTimeImmutableCollection([$dateTimeImmutable]);

        static::assertFalse($dateTimeImmutableCollection->containsDateTimeValue($dateTimeImmutableB));
        static::assertFalse($dateTimeImmutableCollection->containsDateTimeValue($dateTimeImmutableC));
        static::assertTrue($dateTimeImmutableCollection->containsDateTimeValue($dateTimeImmutableD));
    }

    public function testContainsDateTimeValueAfterClone(): void
    {
        $dateTimeImmutable = new \DateTimeImmutable();

        $dateTimeImmutableCollection = (new DateTimeImmutableCollection([$dateTimeImmutable]));
        $dateTimeImmutableCollectionClone = clone ($dateTimeImmutableCollection);

        static::assertTrue($dateTimeImmutableCollection->containsDateTimeValue($dateTimeImmutable));
        static::assertTrue($dateTimeImmutableCollectionClone->containsDateTimeValue($dateTimeImmutable));
    }

    public function testContainsDateTimeValueAfterMerge(): void
    {
        $dateTimeImmutable = new \DateTimeImmutable();

        static::assertTrue(
            (new DateTimeImmutableCollection([$dateTimeImmutable]))
                ->merge(new DateTimeImmutableCollection([new \DateTimeImmutable()]))
                ->containsDateTimeValue($dateTimeImmutable)
        );
    }
}
