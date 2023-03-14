<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer\ObjectCollectionDenormalizer;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection;

class DataCollection extends AbstractObjectCollection
{
    public function __construct()
    {
        parent::__construct(Data::class);
    }

    public function callDoGet(string|int $key): object
    {
        return $this->doGet($key);
    }

    public function add(object $value): static
    {
        return $this->doAdd($value);
    }
}
