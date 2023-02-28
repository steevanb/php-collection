<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection;

interface CollectionInterface extends \ArrayAccess, \Iterator, \Countable
{
    /** @param iterable<mixed> $values */
    public function setValues(iterable $values): static;

    public function resetKeys(): static;

    /** @return array<mixed> */
    public function toArray(): array;

    public function getValueAlreadyExistsMode(): ValueAlreadyExistsModeEnum;
}
