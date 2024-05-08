<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTime\ContainsDateTimeValue;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\ObjectCollection\DateTime\ContainsDateTimeNullableValueTrait;
use Steevanb\PhpCollection\ObjectCollection\DateTime\ContainsDateTimeValueTrait;
use Steevanb\PhpCollection\ObjectCollection\DateTimeCollection;
use Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableCollection;
use Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableNullableCollection;
use Steevanb\PhpCollection\ObjectCollection\DateTimeInterfaceCollection;
use Steevanb\PhpCollection\ObjectCollection\DateTimeInterfaceNullableCollection;
use Steevanb\PhpCollection\ObjectCollection\DateTimeNullableCollection;

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTime\ContainsDateTimeValueTrait
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTime\ContainsDateTimeNullableValueTrait
 * @internal
 */
final class TraitUsageTest extends TestCase
{
    /**
     * @dataProvider provideCollectionUsingTrait
     * @param class-string $class
     */
    public function testUsingTrait(string $class): void
    {
        $reflectionCollection = new \ReflectionClass($class);
        static::assertContains(
            needle: ContainsDateTimeValueTrait::class,
            haystack: array_map(
                static fn (\ReflectionClass $reflectionTrait): string => $reflectionTrait->getName(),
                $reflectionCollection->getTraits()
            )
        );
    }

    /**
     * @dataProvider provideCollectionUsingNullableTrait
     * @param class-string $class
     */
    public function testUsingNullableTrait(string $class): void
    {
        $reflectionCollection = new \ReflectionClass($class);
        static::assertContains(
            needle: ContainsDateTimeNullableValueTrait::class,
            haystack: array_map(
                static fn (\ReflectionClass $reflectionTrait): string => $reflectionTrait->getName(),
                $reflectionCollection->getTraits()
            )
        );
    }

    /** @return iterable<string, array{class: class-string}> */
    public static function provideCollectionUsingTrait(): iterable
    {
        yield 'ContainsDateTimeValueTrait_is_used_by_DateTimeCollection' => [
            'class' => DateTimeCollection::class,
        ];
        yield 'ContainsDateTimeValueTrait_is_used_by_DateTimeImmutableCollection' => [
            'class' => DateTimeImmutableCollection::class,
        ];
        yield 'ContainsDateTimeValueTrait_is_used_by_DateTimeInterfaceCollection' => [
            'class' => DateTimeInterfaceCollection::class,
        ];
    }

    /** @return iterable<string, array{class: class-string}> */
    public static function provideCollectionUsingNullableTrait(): iterable
    {
        yield 'ContainsDateTimeNullableValueTrait_is_used_by_DateTimeNullableCollection' => [
            'class' => DateTimeNullableCollection::class,
        ];
        yield 'ContainsDateTimeNullableValueTrait_is_used_by_DateTimeImmutableNullableCollection' => [
            'class' => DateTimeImmutableNullableCollection::class,
        ];
        yield 'ContainsDateTimeNullableValueTrait_is_used_by_DateTimeInterfaceNullableCollection' => [
            'class' => DateTimeInterfaceNullableCollection::class,
        ];
    }
}
