<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

interface FloatCollectionInterface extends ScalarCollectionInterface
{
    public function set(string|int $key, float $value): static;

    /** @param iterable<string|int, float> $values */
    public function replace(iterable $values): static;

    public function add(float $value): static;

    public function has(float $value): bool;

    public function get(string|int $key): float;

    /** @return array<string|int, float> */
    public function toArray(): array;
}
