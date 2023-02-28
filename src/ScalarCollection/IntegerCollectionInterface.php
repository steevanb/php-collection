<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

interface IntegerCollectionInterface extends ScalarCollectionInterface
{
    public function set(string|int $key, int $value): static;

    /** @param iterable<string|int, int> $values */
    public function replace(iterable $values): static;

    public function add(int $value): static;

    public function has(int $value): bool;

    public function get(string|int $key): int;

    /** @return array<string|int, int> */
    public function toArray(): array;
}
