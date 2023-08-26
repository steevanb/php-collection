<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Bridge\Symfony\Normalizer;

use Steevanb\PhpCollection\{
    CollectionInterface,
    ScalarCollection\FloatCollection,
    ScalarCollection\FloatNullableCollection,
    ScalarCollection\IntegerCollection,
    ScalarCollection\IntegerNullableCollection,
    ScalarCollection\StringCollection,
    ScalarCollection\StringNullableCollection
};
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ScalarCollectionDenormalizer implements DenormalizerInterface
{
    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return in_array(
            $type,
            [
                FloatCollection::class,
                FloatNullableCollection::class,
                IntegerCollection::class,
                IntegerNullableCollection::class,
                StringCollection::class,
                StringNullableCollection::class
            ],
            true
        );
    }

    /** @param array<mixed> $context */
    public function denormalize(
        mixed $data,
        string $type,
        string $format = null,
        array $context = []
    ): CollectionInterface {
        /** @var class-string<CollectionInterface> $type */
        return (new $type())->replace($data);
    }
}
