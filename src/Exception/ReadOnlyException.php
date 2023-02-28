<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Exception;

class ReadOnlyException extends PhpCollectionException
{
    public function __construct()
    {
        parent::__construct('This collection is read only, you cannot edit it\'s values.');
    }
}
