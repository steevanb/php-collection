<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectNullableCollection;

/** @extends AbstractObjectNullableCollection<Data|null> */
class DataNullableCollection extends AbstractObjectNullableCollection
{
    public static function getValueFqcn(): string
    {
        return Data::class;
    }

    public function add(Data|null $value): static
    {
        return $this->doAdd($value);
    }
}
