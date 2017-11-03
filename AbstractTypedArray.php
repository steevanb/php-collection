<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

abstract class AbstractTypedArray implements \ArrayAccess, \Iterator
{
    abstract protected function assertValue($value): self;

    abstract protected function cast($value);

    /** @var int */
    protected $nextIntKey = 0;

    protected $values = [];

    public function __construct(array $values = [], bool $autoCast = false)
    {
        foreach ($values as $key => $value) {
            if ($autoCast) {
                $value = $this->cast($value);
            }
            $this->offsetSet($key, $value);
        }
    }

    /** @return string|int|null */
    public function key()
    {
        return key($this->values);
    }

    public function next()
    {
        $return = next($this->values);

        return $return === false ? null : $return;
    }

    public function current()
    {
        $return = current($this->values);

        return $return === false ? null : $return;
    }

    public function valid(): bool
    {
        return is_int($this->current());
    }

    public function rewind()
    {
        $return = prev($this->values);

        return $return === false ? null : $return;
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

    public function offsetUnset($offset): void
    {
        if ($this->offsetExists($offset)) {
            unset($this->values[$offset]);
        }
    }

    public function asArray(): array
    {
        return $this->values;
    }
}
