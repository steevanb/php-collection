<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection;

use Steevanb\PhpCollection\{
    Exception\KeyNotFoundException,
    Exception\ReadOnlyException,
    Exception\ValueAlreadyExistsException,
    ScalarCollection\IntegerCollection,
    ScalarCollection\IntegerCollectionInterface,
    ScalarCollection\StringCollection,
    ScalarCollection\StringCollectionInterface
};

abstract class AbstractCollection implements CollectionInterface
{
    /** @var array<mixed> */
    protected array $values = [];

    protected bool $readOnly = false;

    /** @param iterable<mixed> $values */
    public function __construct(
        iterable $values = [],
        private readonly ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        $this->doReplace($values);
    }

    public function hasKey(string|int $key): bool
    {
        return array_key_exists($key, $this->values);
    }

    public function remove(string|int $key): static
    {
        $this
            ->assertIsNotReadOnly()
            ->assertHasKey($key);

        unset($this->values[$key]);

        return $this;
    }

    public function resetKeys(): static
    {
        $this->assertIsNotReadOnly();

        $this->values = array_values($this->values);

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

    public function getValueAlreadyExistsMode(): ValueAlreadyExistsModeEnum
    {
        return $this->valueAlreadyExistsMode;
    }

    /** @return array<int, string|int> */
    public function getKeys(): array
    {
        return array_keys($this->values);
    }

    public function getStringKeys(): StringCollectionInterface
    {
        $return = new StringCollection();
        foreach ($this->getKeys() as $key) {
            if (is_string($key)) {
                $return->add($key);
            }
        }

        return $return;
    }

    public function getIntegerKeys(): IntegerCollectionInterface
    {
        $return = new IntegerCollection();
        foreach ($this->getKeys() as $key) {
            if (is_int($key)) {
                $return->add($key);
            }
        }

        return $return;
    }

    public function clear(): static
    {
        $this->assertIsNotReadOnly();
        $this->values = [];

        return $this;
    }

    public function changeKeyCase(KeyCaseEnum $case = KeyCaseEnum::LOWER): static
    {
        return $this
            ->assertIsNotReadOnly()
            ->doReplace(array_change_key_case($this->toArray(), $case->value));
    }

    /** @return array<string|int, mixed> */
    public function toArray(): array
    {
        return $this->values;
    }

    protected function doSet(string|int $key, mixed $value): static
    {
        $this->assertIsNotReadOnly();

        if ($this->canAddValue($value)) {
            $this->values[$key] = $value;
        }

        return $this;
    }

    /** @param iterable<mixed> $values */
    protected function doReplace(iterable $values): static
    {
        $this->assertIsNotReadOnly();

        $this->clear();
        foreach ($values as $key => $value) {
            $this->doSet($key, $value);
        }
        reset($this->values);

        return $this;
    }

    protected function doGet(string|int $key): mixed
    {
        $this->assertHasKey($key);

        return $this->values[$key];
    }

    protected function assertHasKey(string|int $key): static
    {
        if ($this->hasKey($key) === false) {
            throw new KeyNotFoundException($key);
        }

        return $this;
    }

    protected function doHas(mixed $value): bool
    {
        return in_array($value, $this->values, true);
    }

    protected function doAdd(mixed $value): static
    {
        $this->assertIsNotReadOnly();

        if ($this->canAddValue($value)) {
            $this->values[] = $value;
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

    protected function doMerge(CollectionInterface $collection): static
    {
        return $this->doReplace(array_merge($this->values, $collection->toArray()));
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
                            'Value "' . $this->castValueToString($value) . '" already exists.'
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
