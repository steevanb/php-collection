<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer\ObjectCollectionDenormalizer;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectNullableCollection;

class DataNullableCollection extends AbstractObjectNullableCollection
{
    public function __construct()
    {
        parent::__construct(Data::class);
    }

    public function callDoGet(string|int $key): object|null
    {
        return $this->doGet($key);
    }

    public function add(object|null $value): static
    {
        return $this->doAdd($value);
    }
}
