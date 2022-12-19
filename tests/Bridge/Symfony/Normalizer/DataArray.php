<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Bridge\Symfony\Normalizer;

use Steevanb\PhpTypedArray\ObjectArray\ObjectArray;

class DataArray extends ObjectArray
{
    public function __construct(iterable $values = [])
    {
        parent::__construct($values, Data::class);
    }
}
