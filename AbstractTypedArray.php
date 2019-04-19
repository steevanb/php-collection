<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

abstract class AbstractTypedArray implements \ArrayAccess, \Iterator, \Countable
{
    abstract protected function assertValue($value): self;

    /** @var int */
    protected $nextIntKey = 0;

    /** @var array */
    protected $values = [];

    /** @var bool */
    protected $valid = true;

    /** @var bool */
    protected $uniqueValues = false;

    /** @var bool */
    protected $exceptionOnNonUniqueValue = false;

    public function __construct(
        iterable $values = [],
        bool $autoCast = false,
        bool $uniqueValues = false,
        bool $exceptionOnNonUniqueValue = false
    ) {
        $this
            ->setUniqueValues($uniqueValues)
            ->setExceptionOnNonUniqueValue($exceptionOnNonUniqueValue);

        foreach ($values as $key => $value) {
            if ($autoCast) {
                $value = $this->cast($value);
            }
            $this->offsetSet($key, $value);
        }
        reset($this->values);
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

    public function next()
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
        $this->assertValue($value);

        if ($this->isUniqueValues()) {
            foreach ($this->values as $internalValue) {
                if ($value === $internalValue) {
                    if ($this->isExceptionOnNonUniqueValue()) {
                        throw new NonUniqueValueException($value . ' already exist.');
                    }

                    return;
                }
            }
        }

        if ($offset === null) {
            $offset = $this->nextIntKey;
            $this->nextIntKey++;
        } elseif (is_int($offset) && $offset >= $this->nextIntKey) {
            $this->nextIntKey = $offset + 1;
        }

        $this->values[$offset] = $value;
    }

    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset) === false) {
            throw new \Exception('Unknown key "' . $offset . '".');
        }

        return $this->values[$offset];
    }

    public function offsetUnset($offset): void
    {
        if ($this->offsetExists($offset)) {
            unset($this->values[$offset]);
        }
    }

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

    public function asArray(): array
    {
        return $this->values;
    }

    /** @return $this */
    public function merge(iterable $values): self
    {
        foreach ($values as $value) {
            $this->offsetSet(null, $value);
        }

        return $this;
    }

    public function setUniqueValues(bool $uniqueValues): self
    {
        $this->uniqueValues = $uniqueValues;

        return $this;
    }

    public function isUniqueValues(): bool
    {
        return $this->uniqueValues;
    }

    public function setExceptionOnNonUniqueValue(bool $exceptionOnNonUniqueValue): self
    {
        $this->exceptionOnNonUniqueValue = $exceptionOnNonUniqueValue;

        return $this;
    }

    public function isExceptionOnNonUniqueValue(): bool
    {
        return $this->exceptionOnNonUniqueValue;
    }

    protected function cast($value)
    {
        return $value;
    }
}
