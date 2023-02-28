<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

interface StringNullableCollectionInterface extends ScalarCollectionInterface
{
    public function set(string|int $key, string|null $value): static;

    /** @param iterable<string|int, string|null> $values */
    public function replace(iterable $values): static;

    public function add(string|null $value): static;

    public function has(string|null $value): bool;

    public function get(string|int $key): string|null;

    /** @return array<string|int, string|null> */
    public function toArray(): array;
}
