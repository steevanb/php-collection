<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Bridge\Symfony\Normalizer;

use Symfony\Component\Serializer\{
    Normalizer\DenormalizerAwareInterface,
    Normalizer\DenormalizerAwareTrait,
    Normalizer\DenormalizerInterface
};
use Steevanb\PhpCollection\{
    Exception\PhpCollectionException,
    ObjectCollection\AbstractObjectCollection,
    ObjectCollection\AbstractObjectNullableCollection
};

class ObjectCollectionDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return
            is_subclass_of($type, AbstractObjectCollection::class)
            || is_subclass_of($type, AbstractObjectNullableCollection::class);
    }

    /** @param array<mixed> $context */
    public function denormalize(
        mixed $data,
        string $type,
        string $format = null,
        array $context = []
    ): AbstractObjectCollection|AbstractObjectNullableCollection {
        if (is_array($data) === false) {
            throw new PhpCollectionException('$data should be an array.');
        }

        /** @var AbstractObjectCollection|AbstractObjectNullableCollection $collection */
        $collection = new $type();
        foreach ($data as $datum) {
            $collection->add(
                $datum === null
                    ? null
                    : $this->denormalizer->denormalize($datum, $collection::getValueFqcn(), $format, $context)
            );
        }

        return $collection;
    }
}
