<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ObjectArray;

use Symfony\Component\String\ByteString;

class ByteStringArray extends ObjectArray
{
    public function __construct(iterable $values = [])
    {
        parent::__construct($values, ByteString::class);
    }

    public function merge(ByteStringArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }
}
