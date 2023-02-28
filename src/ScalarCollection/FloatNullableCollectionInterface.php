<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

interface FloatNullableCollectionInterface extends ScalarCollectionInterface
{
    public function set(string|int $key, float|null $value): static;

    /** @param iterable<string|int, float|null> $values */
    public function replace(iterable $values): static;

    public function add(float|null $value): static;

    public function has(float|null $value): bool;

    public function get(string|int $key): float|null;

    /** @return array<string|int, float|null> */
    public function toArray(): array;
}
