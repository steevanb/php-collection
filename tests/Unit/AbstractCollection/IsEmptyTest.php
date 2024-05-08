<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use PHPUnit\Framework\TestCase;

final class IsEmptyTest extends TestCase
{
    public function testIsEmptyForDefaultParameters(): void
    {
        static::assertTrue((new Collection())->isEmpty());
    }

    /**
     * @dataProvider dataProviderIsEmpty
     * @param array<mixed> $collectionValues
     */
    public function testIsEmpty(array $collectionValues, bool $expectedIsEmpty): void
    {
        if ($expectedIsEmpty) {
            static::assertTrue((new Collection($collectionValues))->isEmpty());
        } else {
            static::assertFalse((new Collection($collectionValues))->isEmpty());
        }
    }

    public function dataProviderIsEmpty(): \Generator
    {
        yield 'it_returns_true_for_empty_array' => [
            'collectionValues' => [],
            'expectedIsEmpty' => true,
        ];

        yield 'it_returns_false_for_array_with_null' => [
            'collectionValues' => [null],
            'expectedIsEmpty' => false,
        ];
        yield 'it_returns_false_for_array_with_false' => [
            'collectionValues' => [false],
            'expectedIsEmpty' => false,
        ];
        yield 'it_returns_false_for_array_with_empty_string' => [
            'collectionValues' => [''],
            'expectedIsEmpty' => false,
        ];
        yield 'it_returns_false_for_array_with_empty_array' => [
            'collectionValues' => [[]],
            'expectedIsEmpty' => false,
        ];
        yield 'it_returns_false_for_array_with_zero' => [
            'collectionValues' => [0],
            'expectedIsEmpty' => false,
        ];
        yield 'it_returns_false_for_array_with_values' => [
            'collectionValues' => ['foo', true, 0, []],
            'expectedIsEmpty' => false,
        ];
    }
}
