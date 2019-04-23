<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ObjectArray;

use steevanb\PhpTypedArray\AbstractTypedArray;

class ObjectArray extends AbstractTypedArray
{
    public const COMPARISON_STRING = 1;
    public const COMPARISON_OBJECT_HASH = 2;

    /** @var ?string */
    protected $className;

    /** @var int */
    protected $comparisonMode = self::COMPARISON_STRING;

    /** @var ?string */
    protected $instanceOf;

    public function __construct(
        iterable $values = [],
        string $className = null,
        bool $uniqueValues = false,
        bool $exceptionOnNonUniqueValue = false,
        int $comparisonMode = self::COMPARISON_STRING
    ) {
        $this
            ->setClassName($className)
            ->setComparisonMode($comparisonMode);

        parent::__construct($values, false, $uniqueValues, $exceptionOnNonUniqueValue);
    }

    public function setClassName(?string $className): self
    {
        $this->instanceOf = $className;

        return $this;
    }

    public function getClassName(): ?string
    {
        return $this->instanceOf;
    }

    public function setComparisonMode(int $mode): self
    {
        $this->comparisonMode = $mode;

        return $this;
    }

    public function getComparisonMode(): int
    {
        return $this->comparisonMode;
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

    /**
     * @param mixed $firstValue
     * @param mixed $secondValue
     */
    protected function isSameValues($firstValue, $secondValue): bool
    {
        if ($this->getComparisonMode() === static::COMPARISON_STRING) {
            $return = parent::isSameValues(
                $this->convertValueToString($firstValue),
                $this->convertValueToString($secondValue)
            );
        } elseif ($this->getComparisonMode() === static::COMPARISON_OBJECT_HASH) {
            $return = parent::isSameValues(
                is_object($firstValue) ? spl_object_hash($firstValue) : null,
                is_object($secondValue) ? spl_object_hash($secondValue) : null
            );
        } else {
            throw new \Exception('Unknown comparison mode "' . $this->getComparisonMode() . '".');
        }

        return $return;
    }

    /** @param mixed $value */
    protected function convertValueToString($value): ?string
    {
        try {
            $return = parent::convertValueToString($value);
        } catch (\ErrorException $exception) {
            throw new \Exception('Error while converting object to string. Add __toString() to do it.');
        }

        return $return;
    }
}
