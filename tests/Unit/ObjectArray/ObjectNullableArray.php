<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ObjectArray;

use Steevanb\PhpTypedArray\{
    ObjectArray\AbstractObjectNullableArray,
    ObjectArray\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

class ObjectNullableArray extends AbstractObjectNullableArray
{
    public function __construct(
        iterable $values = [],
        ComparisonModeEnum $comparisonMode = ComparisonModeEnum::HASH,
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct(TestObject::class, $values, $comparisonMode, $valueAlreadyExistsMode);
    }
}
