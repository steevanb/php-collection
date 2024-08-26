<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Maker;

class ObjectCollectionMaker extends AbstractCollectionMaker
{
    protected function getCollectionSuffix(): string
    {
        return 'Collection';
    }

    protected function getTemplateName(): string
    {
        return 'ObjectCollection.php.tpl';
    }
}
