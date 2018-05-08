<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

abstract class AbstractTypedArray implements \ArrayAccess, \Iterator, \Countable
{
    abstract protected function assertValue($value): self;

    /** @var int */
    protected $nextIntKey = 0;

    protected $values = [];

    protected $valid = true;

    public function __construct(iterable $values = [], bool $autoCast = false)
    {
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

        return $return === false ? null : $return;
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

    public function count(): int
    {
        return count($this->values);
    }

    public function asArray(): array
    {
        return $this->values;
    }

    protected function cast($value)
    {
        return $value;
    }
}
