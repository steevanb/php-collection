<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ObjectArray;

use Symfony\Component\String\UnicodeString;

class UnicodeStringArray extends ObjectArray
{
    /** @param iterable<UnicodeString> $values */
    public function __construct(iterable $values = [])
    {
        parent::__construct($values, UnicodeString::class);
    }

    public function merge(UnicodeStringArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }
}
