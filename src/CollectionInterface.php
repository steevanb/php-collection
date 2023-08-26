<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection;

use Steevanb\PhpCollection\{
    ScalarCollection\IntegerCollection,
    ScalarCollection\StringCollection
};

/** @template T */
interface CollectionInterface extends \Countable
{
    /** @param iterable<T> $values */
    public function __construct(iterable $values = []);

    public function setReadOnly(bool $readOnly): static;

    public function isReadOnly(): bool;

    public function getValueAlreadyExistsMode(): ValueAlreadyExistsModeEnum;

    public function hasKey(string|int $key): bool;

    /** @return array<int, string|int> */
    public function getKeys(): array;

    public function getIntegerKeys(): IntegerCollection;

    public function getStringKeys(): StringCollection;

    public function resetKeys(): static;

    /** @return T */
    public function get(string|int $key): mixed;

    /** @param T $value */
    public function contains(mixed $value): bool;

    public function remove(string|int $key): static;

    /** @param iterable<T> $values */
    public function replace(iterable $values): static;

    public function clear(): static;

    /** @return array<string|int, T> */
    public function toArray(): array;
}
