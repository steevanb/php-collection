<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection;

class DataCollection extends AbstractObjectCollection
{
    public function __construct()
    {
        parent::__construct(Data::class);
    }
}
