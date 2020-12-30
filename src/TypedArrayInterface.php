<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

interface TypedArrayInterface extends \ArrayAccess, \Iterator, \Countable
{
    /**
     * @param iterable<mixed> $values
     * @return TypedArrayInterface<mixed>
     */
    public function setValues(iterable $values): self;

    /** @return TypedArrayInterface<mixed> */
    public function resetKeys(): self;

    /** @return array<mixed> */
    public function toArray(): array;

    /** @return TypedArrayInterface<mixed> */
    public function setValueAlreadyExistMode(int $valueAlreadyExistMode): self;

    public function getValueAlreadyExistMode(): int;

    /** @return TypedArrayInterface<mixed> */
    public function setNullValueMode(int $mode): self;

    public function getNullValueMode(): int;
}
