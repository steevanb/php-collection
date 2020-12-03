<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray;

use steevanb\PhpTypedArray\ScalarArray\ScalarArray;

class ScalarArrayDenormalizer extends AbstractScalarArrayDenormalizer
{
    protected function getScalarArrayFqcn(): string
    {
        return ScalarArray::class;
    }
}
