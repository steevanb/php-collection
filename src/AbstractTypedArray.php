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
    public const NULL_VALUE_ALLOW = 1;
    public const NULL_VALUE_DO_NOT_ADD = 2;
    public const NULL_VALUE_EXCEPTION = 3;

    public const VALUE_ALREADY_EXIST_ADD = 1;
    public const VALUE_ALREADY_EXIST_DO_NOT_ADD = 2;
    public const VALUE_ALREADY_EXIST_EXCEPTION = 3;

    /** @var int */
    protected $nextIntKey = 0;

    /** @var array<mixed> */
    protected $values = [];

    /** @var bool */
    protected $valid = true;

    /** @var int */
    protected $valueAlreadyExistMode = self::VALUE_ALREADY_EXIST_ADD;

    /** @var int */
    protected $nullValueMode = self::NULL_VALUE_ALLOW;

    /** @var bool */
    protected $readOnly = false;

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

    /** @return string|int|null */
    #[\ReturnTypeWillChange]
    public function key()
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

    /** @return mixed */
    #[\ReturnTypeWillChange]
    public function current()
    {
        $return = current($this->values);

        return ($return === false) ? null : $return;
    }

    public function rewind(): void
    {
        reset($this->values);
        $this->valid = count($this->values) > 0;
    }

    /** @param mixed $offset */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->values);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
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

    /**
     * @param mixed $offset
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset) === false) {
            throw new KeyNotFoundException('Key "' . $offset . '" not found.');
        }

        return $this->values[$offset];
    }

    /** @param mixed $offset */
    public function offsetUnset($offset): void
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

    public function setValueAlreadyExistMode(int $valueAlreadyExistMode): static
    {
        $this->valueAlreadyExistMode = $valueAlreadyExistMode;

        return $this;
    }

    public function getValueAlreadyExistMode(): int
    {
        return $this->valueAlreadyExistMode;
    }

    public function setNullValueMode(int $mode): static
    {
        $this->nullValueMode = $mode;

        return $this;
    }

    public function getNullValueMode(): int
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

    /**
     * @param mixed $firstValue
     * @param mixed $secondValue
     */
    protected function isSameValues($firstValue, $secondValue): bool
    {
        return $firstValue === $secondValue;
    }

    /** @param mixed $value */
    protected function castValueToString($value): string
    {
        return is_null($value) ? 'NULL' : (string) $value;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    protected function canAddValue($offset, $value): bool
    {
        $return = true;

        if (is_null($value)) {
            if ($this->getNullValueMode() === static::NULL_VALUE_DO_NOT_ADD) {
                $return = false;
            } elseif ($this->getNullValueMode() === static::NULL_VALUE_EXCEPTION) {
                throw new NullValueException('NULL value is not allowed for offset ' . $offset . '.');
            }
        }

        if (
            $return === true
            && in_array(
                $this->getValueAlreadyExistMode(),
                [static::VALUE_ALREADY_EXIST_DO_NOT_ADD, static::VALUE_ALREADY_EXIST_EXCEPTION],
                true
            )
        ) {
            foreach ($this->values as $internalValue) {
                if ($this->isSameValues($value, $internalValue)) {
                    if ($this->getValueAlreadyExistMode() === static::VALUE_ALREADY_EXIST_EXCEPTION) {
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
