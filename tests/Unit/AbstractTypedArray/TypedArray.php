<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\AbstractTypedArray;

use Steevanb\PhpTypedArray\AbstractTypedArray;

final class TypedArray extends AbstractTypedArray
{
    public function getNextIntKey(): int
    {
        return $this->nextIntKey;
    }
}
