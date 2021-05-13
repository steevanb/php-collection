<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

interface ReadOnlyInterface
{
    /** @return $this */
    public function setReadOnly(bool $readOnly): self;

    public function isReadOnly(): bool;
}
