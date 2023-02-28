<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

interface IntegerNullableCollectionInterface extends ScalarCollectionInterface
{
    public function set(string|int $key, int|null $value): static;

    /** @param iterable<string|int, int|null> $values */
    public function replace(iterable $values): static;

    public function add(int|null $value): static;

    public function has(int|null $value): bool;

    public function get(string|int $key): int|null;

    /** @return array<string|int, int|null> */
    public function toArray(): array;
}
