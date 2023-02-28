<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection;

use Steevanb\PhpCollection\{
    ScalarCollection\IntegerCollectionInterface,
    ScalarCollection\StringCollectionInterface
};

interface CollectionInterface extends \Countable
{
    public function setReadOnly(bool $readOnly): static;

    public function isReadOnly(): bool;

    public function getValueAlreadyExistsMode(): ValueAlreadyExistsModeEnum;

    public function hasKey(string|int $key): bool;

    /** @return array<int, mixed> */
    public function getKeys(): array;

    public function getIntegerKeys(): IntegerCollectionInterface;

    public function getStringKeys(): StringCollectionInterface;

    public function resetKeys(): static;

    public function remove(string|int $key): static;

    public function clear(): static;

    /** @return array<string|int, mixed> */
    public function toArray(): array;
}
