<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

interface StringCollectionInterface extends ScalarCollectionInterface
{
    public function set(string|int $key, string $value): static;

    /** @param iterable<string|int, string> $values */
    public function replace(iterable $values): static;

    public function add(string $value): static;

    public function has(string $value): bool;

    public function get(string|int $key): string;

    /** @return array<string|int, string> */
    public function toArray(): array;
}
