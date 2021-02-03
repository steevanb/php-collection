<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray;

use steevanb\PhpTypedArray\ObjectArray\ObjectArray;
use Symfony\Component\Serializer\{
    Normalizer\DenormalizerAwareInterface,
    Normalizer\DenormalizerAwareTrait,
    Normalizer\DenormalizerInterface
};

class ObjectArrayDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return is_subclass_of($type, ObjectArray::class);
    }

    /**
     * @var array<mixed> $data
     * @var array<mixed> $context
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ObjectArray
    {
        /** @var ObjectArray $return */
        $return = new $type();
        foreach ($data as $item) {
            $return[] = $this->denormalizer->denormalize($item, $return->getClassName(), $format, $context);
        }

        return $return;
    }
}
