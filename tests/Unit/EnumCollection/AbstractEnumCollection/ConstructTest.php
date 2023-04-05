<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\EnumCollection\AbstractEnumCollection;

use PHPUnit\Framework\TestCase;
use Steevanb\PhpCollection\{
    Tests\Unit\CreateMockForMehodCallTrait,
    ValueAlreadyExistsModeEnum
};

final class ConstructTest extends TestCase
{
    use CreateMockForMehodCallTrait;

    public function testDefaultValues(): void
    {
        $collection = new TestAbstractEnumCollection();

        static::assertSame(
            'Steevanb\PhpCollection\Tests\Unit\EnumCollection\AbstractEnumCollection\TestEnum',
            $collection->getClassName()
        );
        static::assertSame(ValueAlreadyExistsModeEnum::ADD, $collection->getValueAlreadyExistsMode());
        static::assertCount(0, $collection);
    }

    public function testAssertClassNameIsCalled(): void
    {
        $mock = $this->createMockForMethodCall(TestAbstractEnumCollection::class, 'assertClassName', TestEnum::class);

        $mock->__construct();
    }
}
