<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ObjectArray;

use Symfony\Component\String\ByteString;

class ByteStringArray extends ObjectArray
{
    public function __construct(iterable $values = [])
    {
        parent::__construct($values, ByteString::class);
    }
}
