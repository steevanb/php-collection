<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection\DateTimeCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    ObjectCollection\DateTimeCollection
};

/**
 * @covers \Steevanb\PhpCollection\ObjectCollection\DateTimeCollection
 * @internal
 */
final class TypeTest extends TestCase
{
    public function testAllowDateTime(): void
    {
        $dateTime = new \DateTime();
        $dateTimeCollection = new DateTimeCollection([$dateTime]);

        static::assertCount(expectedCount: 1, haystack: $dateTimeCollection);
        static::assertSame(expected: $dateTime, actual: $dateTimeCollection->get(0));
    }

    /** @dataProvider provideInvalidType */
    public function testInvalidType(mixed $value): void
    {
        $this->expectException(InvalidTypeException::class);
        /** @phpstan-ignore-next-line Parameter #1 $values ... constructor expects ... array<int, mixed> given. */
        new DateTimeCollection([$value]);
    }

    /** @return iterable<string, mixed> */
    public static function provideInvalidType(): iterable
    {
        yield 'it_throws_invalid_type_exception_on_null_value' => [
            'value' => null,
        ];
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
        yield 'it_throws_invalid_type_exception_on_DateTime_array_value' => [
            'value' => [new \DateTime()],
        ];
        yield 'it_throws_invalid_type_exception_on_object_value' => [
            'value' => new class() {
            },
        ];
        yield 'it_throws_invalid_type_exception_on_DateTimeCollection_value' => [
            'value' => new DateTimeCollection(),
        ];
    }
}
