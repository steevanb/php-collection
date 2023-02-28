<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use Steevanb\PhpCollection\AbstractCollection;

final class Collection extends AbstractCollection
{
    public function getNextIntKey(): int
    {
        return $this->nextIntKey;
    }
}
