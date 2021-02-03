<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray;

use steevanb\PhpTypedArray\ObjectArray\ByteStringArray;

/** @deprecated Replaced by ObjectArrayDenormalizer */
class ByteStringArrayDenormalizer extends AbstractObjectArrayDenormalizer
{
    protected function getObjectArrayFqcn(): string
    {
        return ByteStringArray::class;
    }
}