<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray;

use steevanb\PhpTypedArray\AbstractTypedArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

abstract class AbstractScalarArrayDenormalizer implements DenormalizerInterface
{
    abstract protected function getScalarArrayFqcn(): string;

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === $this->getScalarArrayFqcn();
    }

    /**
     * Because of ScalarArray who extends AbstractTypedArray wen can't return AbstractScalarArray
     *
     * @var array<mixed> $data
     * @var array<mixed> $context
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): AbstractTypedArray
    {
        return $this
            ->createScalarArray()
            ->setValues($data);
    }

    /** Because of ScalarArray who extends AbstractTypedArray wen can't return AbstractScalarArray */
    protected function createScalarArray(): AbstractTypedArray
    {
        $fqcn = $this->getScalarArrayFqcn();

        return new $fqcn();
    }
}
