<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Bridge\Phpstan\Rules\ForeachLoop;

use PhpParser\Node;
use PHPStan\{
    Analyser\Scope,
    Rules\Rule,
    Rules\RuleLevelHelper,
    Rules\RuleErrorBuilder,
    Type\VerbosityLevel,
    Type\ObjectType,
    Rules\FoundTypeResult
};
use Steevanb\PhpTypedArray\TypedArrayInterface;

class DisallowTypedArrayRule implements Rule
{
    /** @var RuleLevelHelper */
    private $ruleLevelHelper;

    public function __construct(RuleLevelHelper $ruleLevelHelper)
    {
        $this->ruleLevelHelper = $ruleLevelHelper;
    }

    public function getNodeType(): string
    {
        return \PhpParser\Node\Stmt\Foreach_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $return = [];

        $typeResult = $this->ruleLevelHelper->findTypeToCheck(
            $scope,
            $node->expr,
            'Iterating over an object of an unknown class %s.',
            static function (Type $type): bool {
                return $type->isIterable()->yes();
            }
        );

        if (
            $typeResult instanceof FoundTypeResult
            && $typeResult->getType() instanceof ObjectType
            && in_array(TypedArrayInterface::class, class_implements($typeResult->getType()->getClassName()))
        ) {
            $return[] =
                RuleErrorBuilder::message(
                    sprintf(
                        'Due to a bug with \ArrayAccess you need to use TypedArrayInterface::toArray() in foreach.',
                        $typeResult->getType()->describe(VerbosityLevel::typeOnly())
                    )
                )->line($node->expr->getLine())->build();
        }

        return $return;
    }
}
