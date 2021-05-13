<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Exception;

class ReadOnlyException extends PhpTypedArrayException
{
    public function __construct()
    {
        parent::__construct('This typed array is read only, you cannot edit it\'s values.');
    }
}
