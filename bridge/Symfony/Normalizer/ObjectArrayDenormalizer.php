<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\Bridge\Symfony\Normalizer;

use Steevanb\PhpTypedArray\{
    ObjectArray\AbstractObjectArray,
    ObjectArray\AbstractObjectNullableArray
};
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
        return
            $type === AbstractObjectArray::class
            || is_subclass_of($type, AbstractObjectArray::class)
            || $type === AbstractObjectNullableArray::class
            || is_subclass_of($type, AbstractObjectNullableArray::class);
    }

    /**
     * @var array<mixed> $data
     * @var array<mixed> $context
     */
    public function denormalize(
        mixed $data,
        string $type,
        string $format = null,
        array $context = []
    ): AbstractObjectArray|AbstractObjectNullableArray {
        $return = $this->createObjectArray($type);
        foreach ($data as $item) {
            $return[] = $this->denormalizeObject($item, $return, $format, $context);
        }

        return $return;
    }

    protected function createObjectArray(string $type): AbstractObjectArray|AbstractObjectNullableArray
    {
        return new $type();
    }

    protected function denormalizeObject(
        mixed $item,
        AbstractObjectArray|AbstractObjectNullableArray $objectArray,
        ?string $format,
        array $context
    ): object|null {
        return $item === null
            ? null
            : $this->denormalizer->denormalize($item, $objectArray->getClassName(), $format, $context);
    }
}
