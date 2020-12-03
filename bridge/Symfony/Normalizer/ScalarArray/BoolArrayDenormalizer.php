<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray;

use steevanb\PhpTypedArray\ScalarArray\BoolArray;

class BoolArrayDenormalizer extends AbstractScalarArrayDenormalizer
{
    protected function getScalarArrayFqcn(): string
    {
        return BoolArray::class;
    }
}
