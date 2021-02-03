<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray;

use steevanb\PhpTypedArray\ObjectArray\CodePointStringArray;

/** @deprecated Replaced by ObjectArrayDenormalizer */
class CodePointStringArrayDenormalizer extends AbstractObjectArrayDenormalizer
{
    protected function getObjectArrayFqcn(): string
    {
        return CodePointStringArray::class;
    }
}
