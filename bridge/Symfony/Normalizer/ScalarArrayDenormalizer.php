<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer;

use steevanb\PhpTypedArray\{
    AbstractTypedArray,
    ScalarArray\AbstractScalarArray,
    ScalarArray\ScalarArray
};
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ScalarArrayDenormalizer implements DenormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return
            $type === ScalarArray::class
            || is_subclass_of($type, ScalarArray::class)
            || $type === AbstractScalarArray::class
            || is_subclass_of($type, AbstractScalarArray::class);
    }

    /**
     * Because of ScalarArray who extends AbstractTypedArray wen can't return AbstractScalarArray
     *
     * @var array<mixed> $data
     * @var array<mixed> $context
     */
    public function denormalize($data, $type, $format = null, array $context = []): AbstractTypedArray
    {
        return $this
            ->createScalarArray($type)
            ->setValues($data);
    }

    /** Because of ScalarArray who extends AbstractTypedArray wen can't return AbstractScalarArray */
    protected function createScalarArray(string $type): AbstractTypedArray
    {
        return new $type();
    }
}
