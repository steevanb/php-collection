## Informations

This bridge can be used when your project is a Symfony ^4.4||^5.0 project.

## Installation

Add this dependencies to your project:

```bash
composer require symfony/config symfony/dependency-injection symfony/http-kernel
```

Add `PhpTypedArrayBundle` to `config/bundles.php`:
```php
# config/bundles.php
return [
    steevanb\PhpTypedArray\Bridge\Symfony\PhpTypedArrayBundle::class => ['all' => true]
];
```

Add bridge to your autoload into `composer.json`:
```json
{
    "autoload": {
        "psr-4": {
            "steevanb\\PhpTypedArray\\Bridge\\Symfony\\": "vendor/steevanb/php-typed-array/bridge/Symfony"
        }
    }
}
```
## Denormalize array into TypedArray with Symfony serializer

```php
use ScalarArray\StringArray;

// $array will be and instance of StringArray with values: 'foo', 'bar'
$array = $serializer->denormalize(['foo', 'bar'], StringArray::class);
```

## Create your own ObjectArrayDenormalizer

You should not need to do it as
[ObjectArrayDenormalizer](../bridge/Symfony/Normalizer/ObjectArray/ObjectArrayDenormalizer.php)
do it for you.

In case you need to change the behavior, you can create your own `ObjectArrayDenormalizer`:

```php
namespace App\Serializer;

use steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ObjectArray\AbstractObjectArrayDenormalizer;

class FooArrayDenormalizer extends AbstractObjectArrayDenormalizer
{
    protected function getObjectArrayFqcn(): string
    {
        return FooArray::class;
    }
}
```

## Create your own ScalarArrayDenormalizer

```php
namespace App\Serializer;

use steevanb\PhpTypedArray\Bridge\Symfony\Normalizer\ScalarArray\AbstractScalarArrayDenormalizer;

class FooArrayDenormalizer extends AbstractScalarArrayDenormalizer
{
    protected function getObjectArrayFqcn(): string
    {
        return FooArray::class;
    }
}
```
