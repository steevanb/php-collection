<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ObjectArray;

use Symfony\Component\String\CodePointString;

class CodePointStringArray extends ObjectArray
{
    public function __construct(iterable $values = [])
    {
        parent::__construct($values, CodePointString::class);
    }
}
