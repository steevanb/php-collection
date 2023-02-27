<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ObjectArray;

use Steevanb\PhpTypedArray\{
    ObjectArray\AbstractObjectArray,
    ObjectArray\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

class ObjectArray extends AbstractObjectArray
{
    public function __construct(
        iterable $values = [],
        ComparisonModeEnum $comparisonMode = ComparisonModeEnum::HASH,
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD,
        string $className = TestObject::class
    ) {
        parent::__construct($className, $values, $comparisonMode, $valueAlreadyExistsMode);
    }
}
