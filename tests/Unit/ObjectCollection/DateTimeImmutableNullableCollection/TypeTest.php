<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTimeImmutableNullableCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ObjectCollection\DateTimeImmutableNullableCollection
};

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTimeImmutableNullableCollection
 * @internal
 */
final class TypeTest extends TestCase
{
    public function testAllowDateTimeImmutable(): void
    {
        $dateTimeImmutable = new \DateTimeImmutable();
        $dateTimeImmutableNullableCollection = new DateTimeImmutableNullableCollection([$dateTimeImmutable]);

        static::assertCount(expectedCount: 1, haystack: $dateTimeImmutableNullableCollection);
        static::assertSame(expected: $dateTimeImmutable, actual: $dateTimeImmutableNullableCollection->get(0));
    }

    public function testAllowNull(): void
    {
        $dateTimeImmutableNullableCollection = new DateTimeImmutableNullableCollection([null]);

        static::assertCount(expectedCount: 1, haystack: $dateTimeImmutableNullableCollection);
        static::assertNull($dateTimeImmutableNullableCollection->get(0));
    }

    /** @dataProvider provideInvalidType */
    public function testInvalidType(mixed $value): void
    {
        $this->expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line Parameter #1 $values ... constructor expects ... array<int, mixed> given. */
        new DateTimeImmutableNullableCollection([$value]);
    }

    /** @return iterable<string, mixed> */
    public static function provideInvalidType(): iterable
    {
        yield 'it_throws_invalid_type_exception_on_true_value' => [
            'value' => true,
        ];
        yield 'it_throws_invalid_type_exception_on_false_value' => [
            'value' => false,
        ];
        yield 'it_throws_invalid_type_exception_on_string_value' => [
            'value' => '--value--',
        ];
        yield 'it_throws_invalid_type_exception_on_integer_value' => [
            'value' => 42,
        ];
        yield 'it_throws_invalid_type_exception_on_float_value' => [
            'value' => 3.14,
        ];
        yield 'it_throws_invalid_type_exception_on_empty_array_value' => [
            'value' => [],
        ];
        yield 'it_throws_invalid_type_exception_on_DateTimeImmutable_array_value' => [
            'value' => [new \DateTimeImmutable()],
        ];
        yield 'it_throws_invalid_type_exception_on_object_value' => [
            'value' => new class() {
            },
        ];
        yield 'it_throws_invalid_type_exception_on_DateTimeImmutableNullableCollection_value' => [
            'value' => new DateTimeImmutableNullableCollection(),
        ];
    }
}
