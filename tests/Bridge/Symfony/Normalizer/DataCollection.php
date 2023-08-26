<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Bridge\Symfony\Normalizer;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection;

/** @extends AbstractObjectCollection<Data> */
class DataCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return Data::class;
    }

    public function add(Data $value): static
    {
        return $this->doAdd($value);
    }
}
