<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

use steevanb\PhpTypedArray\{
    Exception\KeyNotFoundException,
    Exception\ValueAlreadyExistException,
    Exception\NullValueException
};

abstract class AbstractTypedArray implements \ArrayAccess, \Iterator, \Countable
{
    public const NULL_VALUE_ALLOW = 1;
    public const NULL_VALUE_DO_NOT_ADD = 2;
    public const NULL_VALUE_EXCEPTION = 3;

    public const VALUE_ALREADY_EXIST_ADD = 1;
    public const VALUE_ALREADY_EXIST_DO_NOT_ADD = 2;
    public const VALUE_ALREADY_EXIST_EXCEPTION = 3;

    /** @var int */
    protected $nextIntKey = 0;

    /** @var array */
    protected $values = [];

    /** @var bool */
    protected $valid = true;

    /** @var int */
    protected $valueAlreadyExistMode = self::VALUE_ALREADY_EXIST_ADD;

    /** @var int */
    protected $nullValueMode = self::NULL_VALUE_ALLOW;

    public function __construct(iterable $values = [])
    {
        $this->setValues($values);
    }

    /** @return $this */
    public function setValues(iterable $values): self
    {
        $this->values = [];
        $this->nextIntKey = 0;
        foreach ($values as $key => $value) {
            $this->offsetSet($key, $value);
        }
        reset($this->values);

        return $this;
    }

    /** @return string|int|null */
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

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->values);
    }

    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
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

    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset) === false) {
            throw new KeyNotFoundException('Key "' . $offset . '" not found.');
        }

        return $this->values[$offset];
    }

    public function offsetUnset($offset): void
    {
        if ($this->offsetExists($offset)) {
            unset($this->values[$offset]);
        }
    }

    /** @return $this */
    public function resetKeys(): self
    {
        $this->values = array_values($this->values);
        $this->nextIntKey = count($this->values);

        return $this;
    }

    public function count(): int
    {
        return count($this->values);
    }

    public function toArray(): array
    {
        return $this->values;
    }

    /** @return $this */
    public function setValueAlreadyExistMode(int $valueAlreadyExistMode): self
    {
        $this->valueAlreadyExistMode = $valueAlreadyExistMode;

        return $this;
    }

    public function getValueAlreadyExistMode(): int
    {
        return $this->valueAlreadyExistMode;
    }

    /** @return $this */
    public function setNullValueMode(int $mode): self
    {
        $this->nullValueMode = $mode;

        return $this;
    }

    public function getNullValueMode(): int
    {
        return $this->nullValueMode;
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
        return ($value === null) ? 'NULL' : (string) $value;
    }

    protected function canAddValue($offset, $value): bool
    {
        $return = true;

        if ($value === null) {
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
                [static::VALUE_ALREADY_EXIST_DO_NOT_ADD, static::VALUE_ALREADY_EXIST_EXCEPTION]
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
