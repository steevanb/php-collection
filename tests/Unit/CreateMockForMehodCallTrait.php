<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit;

use PHPUnit\Framework\MockObject\MockBuilder;

trait CreateMockForMehodCallTrait
{
    abstract public function getMockBuilder(string $className): MockBuilder;

    /**
     * @template T
     * @param class-string<T> $className
     * @param mixed ...$parameters
     * @return T
     */
    protected function createMockForMethodCall(string $className, string $method, ...$parameters)
    {
        $return = $this
            ->getMockBuilder($className)
            ->onlyMethods([$method])
            ->disableOriginalConstructor()
            ->getMock();

        $return
            ->expects(static::once())
            ->method($method)
            ->with(...$parameters);

        return $return;
    }
}
