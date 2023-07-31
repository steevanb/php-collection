<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Exception;

class KeyNotFoundException extends PhpCollectionException
{
    public function __construct(string|int $key)
    {
        parent::__construct('Key "' . $key . '" not found.');
    }
}
