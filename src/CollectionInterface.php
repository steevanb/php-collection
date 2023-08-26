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
    public function setReadOnly(bool $readOnly): static;

    public function isReadOnly(): bool;

    public function getValueAlreadyExistsMode(): ValueAlreadyExistsModeEnum;

    public function hasKey(string|int $key): bool;

    /** @return array<int, string|int> */
    public function getKeys(): array;

    public function getIntegerKeys(): IntegerCollection;

    public function getStringKeys(): StringCollection;

    public function resetKeys(): static;

    /** @param T $value */
    public function set(string|int $key, mixed $value): static;

    /** @param iterable<string|int, T> $values */
    public function replace(iterable $values): static;

    /** @param T $value */
    public function add(mixed $value): static;

    /** @param T $value */
    public function has(mixed $value): bool;

    /** @return T */
    public function get(string|int $key): mixed;

    public function remove(string|int $key): static;

    public function clear(): static;

    /** @return array<string|int, T> */
    public function toArray(): array;
}
