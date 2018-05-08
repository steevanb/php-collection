<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

class ObjectArray extends AbstractTypedArray
{
    /** @var ?string */
    protected $instanceOf;

    public function __construct(
        array $values = [],
        string $instanceOf = null,
        bool $uniqueValues = false,
        bool $exceptionOnNonUniqueValue = false
    ) {
        $this->instanceOf = $instanceOf;

        parent::__construct($values, false, $uniqueValues, $exceptionOnNonUniqueValue);
    }

    protected function assertValue($value): AbstractTypedArray
    {
        if (
            is_object($value) === false
            || (
                is_string($this->instanceOf)
                && $value instanceof $this->instanceOf === false
            )
        ) {
            throw new \Exception(
                '$value should be '
                . (is_string($this->instanceOf) ? 'instance of "' . $this->instanceOf . '"' : 'an object')
                . '.'
            );
        }

        return $this;
    }
}
