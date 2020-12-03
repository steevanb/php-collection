<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray;

use steevanb\PhpTypedArray\ObjectArray\ObjectArray;
use Symfony\Component\Serializer\{
    Normalizer\DenormalizerAwareInterface,
    Normalizer\DenormalizerAwareTrait,
    Normalizer\DenormalizerInterface
};

abstract class AbstractObjectArrayDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    abstract protected function getObjectArrayFqcn(): string;

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === $this->getObjectArrayFqcn();
    }

    /**
     * @var array<mixed> $data
     * @var array<mixed> $context
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ObjectArray
    {
        $return = $this->createObjectArray();
        foreach ($data as $item) {
            $return[] = $this->denormalizer->denormalize($item, $return->getClassName(), $format, $context);
        }

        return $return;
    }

    protected function createObjectArray(): ObjectArray
    {
        $fqcn = $this->getObjectArrayFqcn();

        return new $fqcn();
    }
}
