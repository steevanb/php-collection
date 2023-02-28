<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection;

interface ReadOnlyInterface
{
    public function setReadOnly(bool $readOnly): static;

    public function isReadOnly(): bool;
}
