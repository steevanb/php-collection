<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ObjectArray;

use Symfony\Component\String\UnicodeString;

class UnicodeStringArray extends ObjectArray
{
    /** @param iterable<UnicodeString> $values */
    public function __construct(iterable $values = [])
    {
        parent::__construct($values, UnicodeString::class);
    }

    public function merge(UnicodeStringArray $typedArray): self
    {
        parent::doMerge($typedArray);

        return $this;
    }
}
