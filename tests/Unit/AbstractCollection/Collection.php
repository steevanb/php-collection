<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\AbstractCollection;

use Steevanb\PhpCollection\AbstractCollection;

/** @extends AbstractCollection<mixed> */
final class Collection extends AbstractCollection
{
    protected function assertValueType(mixed $value): static
    {
        return $this;
    }
}
