<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Bridge\Symfony\Normalizer;

use Steevanb\PhpTypedArray\{
    AbstractTypedArray,
    ScalarArray\ScalarArrayInterface
};
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ScalarArrayDenormalizer implements DenormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null): bool
    {
        $interfaces = class_implements($type);

        return is_array($interfaces) && array_key_exists(ScalarArrayInterface::class, $interfaces);
    }

    /** @var array<mixed> $context */
    public function denormalize(mixed $data, string $type, $format = null, array $context = []): AbstractTypedArray
    {
        return $this
            ->createScalarArray($type)
            ->setValues($data);
    }

    protected function createScalarArray(string $type): AbstractTypedArray
    {
        return new $type();
    }
}
