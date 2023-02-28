<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection;

use Steevanb\PhpCollection\{
    ObjectCollection\AbstractObjectNullableCollection,
    ObjectCollection\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

class ObjectNullableCollection extends AbstractObjectNullableCollection
{
    public function __construct(
        iterable $values = [],
        ComparisonModeEnum $comparisonMode = ComparisonModeEnum::HASH,
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct(TestObject::class, $values, $comparisonMode, $valueAlreadyExistsMode);
    }

    public function get(string|int $key): object|null
    {
        return $this->doGet($key);
    }
}
