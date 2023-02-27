<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Bridge\Symfony\Normalizer;

use Steevanb\PhpTypedArray\ObjectArray\AbstractObjectArray;

class DataArray extends AbstractObjectArray
{
    public function __construct()
    {
        parent::__construct(Data::class);
    }
}
