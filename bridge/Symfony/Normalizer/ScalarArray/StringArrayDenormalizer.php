<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray;

use steevanb\PhpTypedArray\ScalarArray\StringArray;

class StringArrayDenormalizer extends AbstractScalarArrayDenormalizer
{
    protected function getScalarArrayFqcn(): string
    {
        return StringArray::class;
    }
}
