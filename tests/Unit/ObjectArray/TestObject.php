<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Tests\Unit\ObjectArray;

final class TestObject
{
    private string $toString;

    public function __construct(string $toString)
    {
        $this->toString = $toString;
    }

    public function __toString(): string
    {
        return $this->toString;
    }
}
