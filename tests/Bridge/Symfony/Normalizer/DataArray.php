<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Bridge\Symfony\Normalizer;

use steevanb\PhpTypedArray\ObjectArray\ObjectArray;

class DataArray extends ObjectArray
{
    public function __construct(iterable $values = [])
    {
        parent::__construct($values, Data::class);
    }
}
