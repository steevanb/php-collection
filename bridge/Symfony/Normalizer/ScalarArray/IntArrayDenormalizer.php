<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray;

use steevanb\PhpTypedArray\ScalarArray\IntArray;

class IntArrayDenormalizer extends AbstractScalarArrayDenormalizer
{
    protected function getScalarArrayFqcn(): string
    {
        return IntArray::class;
    }
}
