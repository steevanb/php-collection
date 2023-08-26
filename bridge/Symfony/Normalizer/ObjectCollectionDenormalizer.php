<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Bridge\Symfony\Normalizer;

use Steevanb\PhpCollection\{
    Exception\PhpCollectionException,
    ObjectCollection\AbstractObjectCollection,
    ObjectCollection\AbstractObjectNullableCollection
};
use Symfony\Component\Serializer\{
    Normalizer\DenormalizerAwareInterface,
    Normalizer\DenormalizerAwareTrait,
    Normalizer\DenormalizerInterface
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
        /** @var class-string<AbstractObjectCollection|AbstractObjectNullableCollection> $type */

        if (is_array($data) === false) {
            throw new PhpCollectionException('$data should be an array, ' . get_debug_type($data) . ' given.');
        }

        $values = [];
        foreach ($data as $value) {
            $values[] = $this->denormalizeValue($value, $type, $format, $context);
        }

        return new $type($values);
    }

    /**
     * @param class-string<AbstractObjectCollection|AbstractObjectNullableCollection> $collectionFqcn
     * @param array<mixed> $context
     */
    protected function denormalizeValue(
        mixed $value,
        string $collectionFqcn,
        ?string $format,
        array $context
    ): object|null {
        return $value === null
            ? null
            : $this->denormalizer->denormalize($value, $collectionFqcn::getValueFqcn(), $format, $context);
    }
}
