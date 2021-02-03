<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray;

use steevanb\PhpTypedArray\ObjectArray\UnicodeStringArray;

/** @deprecated Replaced by ObjectArrayDenormalizer */
class UnicodeStringArrayDenormalizer extends AbstractObjectArrayDenormalizer
{
    protected function getObjectArrayFqcn(): string
    {
        return UnicodeStringArray::class;
    }
}
