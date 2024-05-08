<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTimeImmutableNullableCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableNullableCollection;

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableNullableCollection::containsDateTimeValue
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

        $dateTimeImmutableNullableCollection = new DateTimeImmutableNullableCollection([$dateTimeImmutableA, null]);

        static::assertTrue($dateTimeImmutableNullableCollection->containsDateTimeValue($dateTimeImmutableA));
        static::assertTrue($dateTimeImmutableNullableCollection->containsDateTimeValue($dateTimeImmutableCopy));
        static::assertFalse($dateTimeImmutableNullableCollection->containsDateTimeValue($dateTimeImmutableB));
        static::assertTrue($dateTimeImmutableNullableCollection->containsDateTimeValue($dateTimeImmutableClone));
        static::assertTrue($dateTimeImmutableNullableCollection->containsDateTimeValue($dateTimeImmutableSameTime));
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

        $dateTimeImmutableNullableCollection = new DateTimeImmutableNullableCollection([$dateTimeImmutable]);

        static::assertFalse($dateTimeImmutableNullableCollection->containsDateTimeValue($dateTimeImmutableB));
        static::assertFalse($dateTimeImmutableNullableCollection->containsDateTimeValue($dateTimeImmutableC));
        static::assertTrue($dateTimeImmutableNullableCollection->containsDateTimeValue($dateTimeImmutableD));
    }

    public function testContainsDateTimeValueAfterClone(): void
    {
        $dateTimeImmutable = new \DateTimeImmutable();

        $dateTimeImmutableNullableCollection = (new DateTimeImmutableNullableCollection([$dateTimeImmutable]));
        $dateTimeImmutableNullableCollectionClone = clone ($dateTimeImmutableNullableCollection);

        static::assertTrue($dateTimeImmutableNullableCollection->containsDateTimeValue($dateTimeImmutable));
        static::assertTrue($dateTimeImmutableNullableCollectionClone->containsDateTimeValue($dateTimeImmutable));
    }

    public function testContainsDateTimeValueAfterMerge(): void
    {
        $dateTimeImmutable = new \DateTimeImmutable();

        static::assertTrue(
            (new DateTimeImmutableNullableCollection([$dateTimeImmutable]))
                ->merge(new DateTimeImmutableNullableCollection([new \DateTimeImmutable()]))
                ->containsDateTimeValue($dateTimeImmutable)
        );
    }
}
