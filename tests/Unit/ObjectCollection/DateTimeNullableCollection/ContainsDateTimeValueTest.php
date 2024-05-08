<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTimeNullableCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\ObjectCollection\DateTimeNullableCollection;

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTimeNullableCollection::containsDateTimeValue
 * @internal
 */
final class ContainsDateTimeValueTest extends TestCase
{
    public function testContainsDateTimeValue(): void
    {
        $dateTimeA = new \DateTime();
        $dateTimeCopy = $dateTimeA;
        // Asserting different timestamps
        $dateTimeB = (new \DateTime())->add(new \DateInterval('PT1S'));
        $dateTimeClone = clone $dateTimeA;
        $dateTimeSameTime = (new \DateTime())->setTimestamp($dateTimeA->getTimestamp());

        $dateTimeNullableCollection = new DateTimeNullableCollection([$dateTimeA, null]);

        static::assertTrue($dateTimeNullableCollection->containsDateTimeValue($dateTimeA));
        static::assertTrue($dateTimeNullableCollection->containsDateTimeValue($dateTimeCopy));
        static::assertFalse($dateTimeNullableCollection->containsDateTimeValue($dateTimeB));
        static::assertTrue($dateTimeNullableCollection->containsDateTimeValue($dateTimeClone));
        static::assertTrue($dateTimeNullableCollection->containsDateTimeValue($dateTimeSameTime));
    }

    public function testContainsDateTimeValueWithTimezone(): void
    {
        $dateTime = new \DateTime('2024-07-14 12:00:00');
        $dateTimeB = clone $dateTime;
        $dateTimeC = clone $dateTime;
        $dateTimeD = clone $dateTime;

        // Setting timezones
        $dateTime->setTimezone(new \DateTimeZone('+0800'));
        $dateTimeB->setTimezone(new \DateTimeZone('+0600'));
        $dateTimeC->setTimezone(new \DateTimeZone('-0600'));
        $dateTimeD->setTimezone($dateTime->getTimezone());

        $dateTimeNullableCollection = new DateTimeNullableCollection([$dateTime]);

        static::assertFalse($dateTimeNullableCollection->containsDateTimeValue($dateTimeB));
        static::assertFalse($dateTimeNullableCollection->containsDateTimeValue($dateTimeC));
        static::assertTrue($dateTimeNullableCollection->containsDateTimeValue($dateTimeD));
    }

    public function testContainsDateTimeValueAfterClone(): void
    {
        $dateTime = new \DateTime();

        $dateTimeNullableCollection = (new DateTimeNullableCollection([$dateTime]));
        $dateTimeNullableCollectionClone = clone ($dateTimeNullableCollection);

        static::assertTrue($dateTimeNullableCollection->containsDateTimeValue($dateTime));
        static::assertTrue($dateTimeNullableCollectionClone->containsDateTimeValue($dateTime));
    }

    public function testContainsDateTimeValueAfterMerge(): void
    {
        $dateTime = new \DateTime();

        static::assertTrue(
            (new DateTimeNullableCollection([$dateTime]))
                ->merge(new DateTimeNullableCollection([new \DateTime()]))
                ->containsDateTimeValue($dateTime)
        );
    }
}
