<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray;

use Steevanb\PhpTypedArray\{
    Exception\KeyNotFoundException,
    Exception\ReadOnlyException,
    Exception\ValueAlreadyExistException,
    Exception\NullValueException
};

abstract class AbstractTypedArray implements TypedArrayInterface, ReadOnlyInterface
{
    protected int $nextIntKey = 0;

    /** @var array<mixed> */
    protected array $values = [];

    protected bool $valid = true;

    protected ValueAlreadyExistsModeEnum $valueAlreadyExistMode = ValueAlreadyExistsModeEnum::ADD;

    protected NullValueModeEnum $nullValueMode = NullValueModeEnum::ALLOW;

    protected bool $readOnly = false;

    /** @param iterable<mixed> $values */
    public function __construct(iterable $values = [])
    {
        $this->setValues($values);
    }

    /** @param iterable<mixed> $values */
    public function setValues(iterable $values): static
    {
        $this->assertIsNotReadOnly();

        $this->values = [];
        $this->nextIntKey = 0;
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

        if ($this->canAddValue($offset, $value)) {
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

    public function setValueAlreadyExistMode(ValueAlreadyExistsModeEnum $valueAlreadyExistMode): static
    {
        $this->valueAlreadyExistMode = $valueAlreadyExistMode;

        return $this;
    }

    public function getValueAlreadyExistMode(): ValueAlreadyExistsModeEnum
    {
        return $this->valueAlreadyExistMode;
    }

    public function setNullValueMode(NullValueModeEnum $mode): static
    {
        $this->nullValueMode = $mode;

        return $this;
    }

    public function getNullValueMode(): NullValueModeEnum
    {
        return $this->nullValueMode;
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
        $this->assertIsNotReadOnly();
        $newValues = array_change_key_case($this->toArray(), $case);
        $this->clear();
        foreach ($newValues as $key => $value) {
            $this->offsetSet($key, $value);
        }

        return $this;
    }

    protected function assertIsNotReadOnly(): static
    {
        if ($this->isReadOnly()) {
            throw new ReadOnlyException();
        }

        return $this;
    }

    protected function doMerge(AbstractTypedArray $typedArray): static
    {
        return $this->setValues(array_merge($this->values, $typedArray->toArray()));
    }

    protected function isSameValues(mixed $firstValue, mixed $secondValue): bool
    {
        return $firstValue === $secondValue;
    }

    protected function castValueToString(mixed $value): string
    {
        return is_null($value) ? 'NULL' : (string) $value;
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        $return = true;

        if (is_null($value)) {
            if ($this->getNullValueMode() === NullValueModeEnum::DO_NOT_ADD) {
                $return = false;
            } elseif ($this->getNullValueMode() === NullValueModeEnum::EXCEPTION) {
                throw new NullValueException('NULL value is not allowed for offset ' . $offset . '.');
            }
        }

        if (
            $return === true
            && in_array(
                $this->getValueAlreadyExistMode(),
                [ValueAlreadyExistsModeEnum::DO_NOT_ADD, ValueAlreadyExistsModeEnum::EXCEPTION],
                true
            )
        ) {
            foreach ($this->values as $internalValue) {
                if ($this->isSameValues($value, $internalValue)) {
                    if ($this->getValueAlreadyExistMode() === ValueAlreadyExistsModeEnum::EXCEPTION) {
                        throw new ValueAlreadyExistException(
                            'Value "' . $this->castValueToString($value) . '" already exist.'
                        );
                    }

                    $return = false;
                }
            }
        }

        return $return;
    }
}
