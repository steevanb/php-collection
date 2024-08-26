<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Maker;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection;

class ObjectNullableCollectionMaker extends AbstractCollectionMaker
{
    protected function getCollectionSuffix(): string
    {
        return 'NullableCollection';
    }

    protected function getTemplateName(): string
    {
        return 'ObjectNullableCollection.php.tpl';
    }
}
