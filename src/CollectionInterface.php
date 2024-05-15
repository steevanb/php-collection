<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection;

/** @template TValueType */
interface CollectionInterface extends \Countable
{
    /** @param TValueType $value */
    public function set(string|int $key, mixed $value): static;

    /** @param iterable<string|int, TValueType> $values */
    public function replace(iterable $values): static;

    /** @param TValueType $value */
    public function add(mixed $value): static;

    /** @return TValueType */
    public function get(string|int $key): mixed;

    public function remove(string|int $key): static;

    public function clear(): static;

    public function isEmpty(): bool;

    /** @param TValueType $value */
    public function contains(mixed $value): bool;

    public function resetKeys(): static;

    /** @return array<int, string|int> */
    public function getKeys(): array;

    public function hasKey(string|int $key): bool;

    public function setReadOnly(): static;

    public function isReadOnly(): bool;

    public function getValueAlreadyExistsMode(): ValueAlreadyExistsModeEnum;

    /** @return array<string|int, TValueType> */
    public function toArray(): array;
}
