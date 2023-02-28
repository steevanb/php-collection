<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use Steevanb\PhpCollection\AbstractCollection;

final class Collection extends AbstractCollection
{
    public function callDoSet(string|int $key, mixed $value): static
    {
        return $this->doSet($key, $value);
    }

    public function callDoAdd(mixed $value): static
    {
        return $this->doAdd($value);
    }

    public function callDoGet(string|int $key): mixed
    {
        return $this->doGet($key);
    }

    /** @param iterable<string|int, mixed> $values */
    public function callDoReplace(iterable $values): static
    {
        return $this->doReplace($values);
    }
}
