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
    /** @param array<mixed> $context */
    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
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

    /** @return array<class-string|'*'|'object'|string, bool|null> */
    public function getSupportedTypes(?string $format): array
    {
        return [
            FloatCollection::class => false,
            FloatNullableCollection::class => false,
            IntegerCollection::class => false,
            IntegerNullableCollection::class => false,
            StringCollection::class => false,
            StringNullableCollection::class => false
        ];
    }

    /**
     * @param array<mixed> $context
     * @return CollectionInterface<float|integer|string|null>
     */
    public function denormalize(
        mixed $data,
        string $type,
        string $format = null,
        array $context = []
    ): CollectionInterface {
        /**
         * @var class-string<CollectionInterface<float|integer|string|null>> $type
         * @var array<float|int|string|null> $data
         */
        return (new $type())->replace($data);
    }
}
