<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer;

use steevanb\PhpTypedArray\ObjectArray\ObjectArray;
use Symfony\Component\Serializer\{
    Normalizer\DenormalizerAwareInterface,
    Normalizer\DenormalizerAwareTrait,
    Normalizer\DenormalizerInterface
};

class ObjectArrayDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === ObjectArray::class || is_subclass_of($type, ObjectArray::class);
    }

    /**
     * @var array<mixed> $data
     * @var array<mixed> $context
     */
    public function denormalize($data, $type, $format = null, array $context = []): ObjectArray
    {
        $return = $this->createObjectArray($type);
        foreach ($data as $item) {
            $return[] = $this->denormalizeObject($item, $return, $format, $context);
        }

        return $return;
    }

    protected function createObjectArray(string $type): ObjectArray
    {
        return new $type([]);
    }

    /** @return object */
    protected function denormalizeObject($item, ObjectArray $objectArray, ?string $format, array $context)
    {
        return $this->denormalizer->denormalize($item, $objectArray->getClassName(), $format, $context);
    }
}
