<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection;

use Steevanb\PhpCollection\{
    Exception\KeyNotFoundException,
    Exception\ReadOnlyException,
    Exception\ValueAlreadyExistsException
};

abstract class AbstractCollection implements CollectionInterface, ReadOnlyInterface
{
    protected int $nextIntKey = 0;

    /** @var array<mixed> */
    protected array $values = [];

    protected bool $valid = true;

    protected bool $readOnly = false;

    /** @param iterable<mixed> $values */
    public function __construct(
        iterable $values = [],
        private readonly ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        $this->setValues($values);
    }

    /** @param iterable<mixed> $values */
    public function setValues(iterable $values): static
    {
        $this->assertIsNotReadOnly();

        $this->clear();
        foreach ($values as $key => $value) {
            $this->offsetSet($key, $value);
        }
        reset($this->values);

        return $this;
    }

    public function key(): string|int|null
    {
        return $this->valid() ? key($this->values) : null;
    }

    public function valid(): bool
    {
        return $this->valid;
    }

    public function next(): void
    {
        $this->valid = next($this->values) !== false;
    }

    public function current(): mixed
    {
        $return = current($this->values);

        return ($return === false) ? null : $return;
    }

    public function rewind(): void
    {
        reset($this->values);
        $this->valid = count($this->values) > 0;
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->values);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->assertIsNotReadOnly();

        if (is_null($offset)) {
            $offset = $this->nextIntKey;
            $offsetWasNull = true;
        } else {
            $offsetWasNull = false;
        }

        if ($this->canAddValue($value)) {
            if ($offsetWasNull) {
                $this->nextIntKey++;
            } elseif (is_int($offset) && $offset >= $this->nextIntKey) {
                $this->nextIntKey = $offset + 1;
            }

            $this->values[$offset] = $value;
        }
    }

    public function offsetGet(mixed $offset): mixed
    {
        if ($this->offsetExists($offset) === false) {
            throw new KeyNotFoundException('Key "' . $offset . '" not found.');
        }

        return $this->values[$offset];
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->assertIsNotReadOnly();

        if ($this->offsetExists($offset)) {
            unset($this->values[$offset]);
        }
    }

    public function resetKeys(): static
    {
        $this->assertIsNotReadOnly();

        $this->values = array_values($this->values);
        $this->nextIntKey = count($this->values);

        return $this;
    }

    public function count(): int
    {
        return count($this->values);
    }

    public function setReadOnly(bool $readOnly = true): static
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function isReadOnly(): bool
    {
        return $this->readOnly;
    }

    /** @return array<mixed> */
    public function toArray(): array
    {
        return $this->values;
    }

    public function getValueAlreadyExistsMode(): ValueAlreadyExistsModeEnum
    {
        return $this->valueAlreadyExistsMode;
    }

    public function clear(): static
    {
        $this->assertIsNotReadOnly();
        $this->values = [];
        $this->nextIntKey = 0;

        return $this;
    }

    public function changeKeyCase(int $case = CASE_LOWER): static
    {
        return $this
            ->assertIsNotReadOnly()
            ->setValues(array_change_key_case($this->toArray(), $case));
    }

    protected function assertIsNotReadOnly(): static
    {
        if ($this->isReadOnly()) {
            throw new ReadOnlyException();
        }

        return $this;
    }

    protected function doMerge(AbstractCollection $collection): static
    {
        return $this->setValues(array_merge($this->values, $collection->toArray()));
    }

    protected function isSameValues(mixed $firstValue, mixed $secondValue): bool
    {
        return $firstValue === $secondValue;
    }

    protected function castValueToString(mixed $value): string
    {
        return is_null($value) ? 'NULL' : (string) $value;
    }

    protected function canAddValue(mixed $value): bool
    {
        $return = true;

        if (
            in_array(
                $this->getValueAlreadyExistsMode(),
                [ValueAlreadyExistsModeEnum::DO_NOT_ADD, ValueAlreadyExistsModeEnum::EXCEPTION],
                true
            )
        ) {
            foreach ($this->values as $internalValue) {
                if ($this->isSameValues($value, $internalValue)) {
                    if ($this->getValueAlreadyExistsMode() === ValueAlreadyExistsModeEnum::EXCEPTION) {
                        throw new ValueAlreadyExistsException(
                            'Value "' . $this->castValueToString($value) . '" already exist.'
                        );
                    }

                    $return = false;
                    break;
                }
            }
        }

        return $return;
    }
}
