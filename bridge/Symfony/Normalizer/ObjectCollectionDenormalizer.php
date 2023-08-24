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

    /**
     * @param array<mixed> $context
     * @return AbstractObjectCollection<object>|AbstractObjectNullableCollection<object|null>
     */
    public function denormalize(
        mixed $data,
        string $type,
        string $format = null,
        array $context = []
    ): AbstractObjectCollection|AbstractObjectNullableCollection {
        /** @var class-string<AbstractObjectCollection<object>|AbstractObjectNullableCollection<object|null>> $type */

        if (is_array($data) === false) {
            throw new PhpCollectionException('$data should be an array.');
        }

        /** @var AbstractObjectCollection<object>|AbstractObjectNullableCollection<object|null> $collection */
        $collection = $this->createCollection($type);
        foreach ($data as $datum) {
            if (is_null($datum)) {
                $add = null;
            } else {
                /** @var object|null $add */
                $add = $this->denormalizer->denormalize($datum, $collection::getValueFqcn(), $format, $context);
            }
            $collection->add($add);
        }

        return $collection;
    }

    /**
     * @param class-string<AbstractObjectCollection<object>|AbstractObjectNullableCollection<object|null>> $fqcn
     * @return AbstractObjectCollection<object>|AbstractObjectNullableCollection<object|null>
     */
    protected function createCollection(string $fqcn): AbstractObjectCollection|AbstractObjectNullableCollection
    {
        return new $fqcn();
    }
}
