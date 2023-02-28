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
            $type === AbstractObjectCollection::class
            || is_subclass_of($type, AbstractObjectCollection::class)
            || $type === AbstractObjectNullableCollection::class
            || is_subclass_of($type, AbstractObjectNullableCollection::class);
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
    ): AbstractObjectCollection|AbstractObjectNullableCollection {
        $return = $this->createObjectCollection($type);
        foreach ($data as $value) {
            $this->add(
                $return,
                $this->denormalizeObject($value, $return, $format, $context)
            );
        }

        return $return;
    }

    protected function createObjectCollection(string $type): AbstractObjectCollection|AbstractObjectNullableCollection
    {
        return new $type();
    }

    protected function add(
        AbstractObjectCollection|AbstractObjectNullableCollection $collection,
        object|null $value
    ): static {
        if (method_exists($collection, 'add') === false) {
            throw new PhpCollectionException('Unable to find how to add a value in ' . $collection::class . '.');
        }

        $collection->add($value);

        return $this;
    }

    protected function denormalizeObject(
        mixed $value,
        AbstractObjectCollection|AbstractObjectNullableCollection $objectCollection,
        ?string $format,
        array $context
    ): object|null {
        return $value === null
            ? null
            : $this->denormalizer->denormalize($value, $objectCollection->getClassName(), $format, $context);
    }
}
