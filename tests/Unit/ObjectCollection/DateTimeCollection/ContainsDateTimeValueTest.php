<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTimeCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\ObjectCollection\DateTimeCollection;

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTimeCollection::containsDateTimeValue
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

        $dateTimeCollection = new DateTimeCollection([$dateTimeA]);

        static::assertTrue($dateTimeCollection->containsDateTimeValue($dateTimeA));
        static::assertTrue($dateTimeCollection->containsDateTimeValue($dateTimeCopy));
        static::assertFalse($dateTimeCollection->containsDateTimeValue($dateTimeB));
        static::assertTrue($dateTimeCollection->containsDateTimeValue($dateTimeClone));
        static::assertTrue($dateTimeCollection->containsDateTimeValue($dateTimeSameTime));
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

        $dateTimeCollection = new DateTimeCollection([$dateTime]);

        static::assertFalse($dateTimeCollection->containsDateTimeValue($dateTimeB));
        static::assertFalse($dateTimeCollection->containsDateTimeValue($dateTimeC));
        static::assertTrue($dateTimeCollection->containsDateTimeValue($dateTimeD));
    }

    public function testContainsDateTimeValueAfterClone(): void
    {
        $dateTime = new \DateTime();

        $dateTimeCollection = (new DateTimeCollection([$dateTime]));
        $dateTimeCollectionClone = clone ($dateTimeCollection);

        static::assertTrue($dateTimeCollection->containsDateTimeValue($dateTime));
        static::assertTrue($dateTimeCollectionClone->containsDateTimeValue($dateTime));
    }

    public function testContainsDateTimeValueAfterMerge(): void
    {
        $dateTime = new \DateTime();

        static::assertTrue(
            (new DateTimeCollection([$dateTime]))
                ->merge(new DateTimeCollection([new \DateTime()]))
                ->containsDateTimeValue($dateTime)
        );
    }
}
