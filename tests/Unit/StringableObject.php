<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit;

class StringableObject implements \Stringable
{
    public function __toString(): string
    {
        return 'foo';
    }
}
