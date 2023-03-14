<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\Exception;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\Exception\ReadOnlyException;

final class ReadOnlyExceptionTest extends TestCase
{
    /** @covers \Steevanb\PhpCollection\Exception\ReadOnlyException::__construct */
    public function testDefault(): void
    {
        $exception = new ReadOnlyException();

        static::assertSame('This collection is read only, you cannot edit it\'s values.', $exception->getMessage());
    }
}
