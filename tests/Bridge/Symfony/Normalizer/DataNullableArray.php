<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Bridge\Symfony\Normalizer;

use Steevanb\PhpTypedArray\ObjectArray\AbstractObjectNullableArray;

class DataNullableArray extends AbstractObjectNullableArray
{
    public function __construct()
    {
        parent::__construct(Data::class);
    }
}
