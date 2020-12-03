<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray;

use steevanb\PhpTypedArray\ScalarArray\FloatArray;

class FloatArrayDenormalizer extends AbstractScalarArrayDenormalizer
{
    protected function getScalarArrayFqcn(): string
    {
        return FloatArray::class;
    }
}
