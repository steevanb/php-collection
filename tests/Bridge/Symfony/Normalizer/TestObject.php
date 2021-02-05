<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Tests\Bridge\Symfony\Normalizer;

final class TestObject
{
    /** @var string */
    public $foo;

    /** @var int */
    public $bar;

    public function __construct(string $foo, int $bar)
    {
        $this->foo = $foo;
        $this->bar = $bar;
    }
}
