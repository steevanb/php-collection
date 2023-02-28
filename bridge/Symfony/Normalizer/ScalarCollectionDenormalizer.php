<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Bridge\Symfony\Normalizer;

use Steevanb\PhpCollection\{
    AbstractCollection,
    ScalarCollection\ScalarCollectionInterface
};
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ScalarCollectionDenormalizer implements DenormalizerInterface
{
    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        $interfaces = class_implements($type);

        return is_array($interfaces) && array_key_exists(ScalarCollectionInterface::class, $interfaces);
    }

    public function denormalize(
        mixed $data,
        string $type,
        string $format = null,
        array $context = []
    ): AbstractCollection {
        return $this
            ->createScalarCollection($type)
            ->setValues($data);
    }

    protected function createScalarCollection(string $type): AbstractCollection
    {
        return new $type();
    }
}
