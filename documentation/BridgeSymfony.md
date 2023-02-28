## Informations

This bridge can be used when your project is a Symfony ^4.4||^5.0 project.

## Installation

Add this dependencies to your project:

```bash
composer require symfony/config symfony/dependency-injection symfony/http-kernel
```

Add `PhpCollectionBundle` to `config/bundles.php`:
```php
# config/bundles.php
return [
    Steevanb\PhpCollection\Bridge\Symfony\PhpCollectionBundle::class => ['all' => true]
];
```

Add bridge to your autoload into `composer.json`:
```json
{
    "autoload": {
        "psr-4": {
            "steevanb\\PhpCollection\\Bridge\\Symfony\\": "vendor/steevanb/php-collection/bridge/Symfony"
        }
    }
}
```
## Denormalize array into Collection with Symfony serializer

```php
// $collection will be and instance of StringCollection with values: 'foo', 'bar'
$collection = $serializer->denormalize(['foo', 'bar'], StringCollection::class);
```

## Create your own ObjectCollectionDenormalizer

You should not need to do it as
[ObjectCollectionDenormalizer](../bridge/Symfony/Normalizer/ObjectCollectionDenormalizer.php)
do it for you.

In case you need to change the behavior, you can create your own `ObjectCollectionDenormalizer`:

```php
namespace App\Serializer;

use Steevanb\PhpCollection\Bridge\Symfony\Normalizer\ObjectCollectionDenormalizer;

class FooCollectionDenormalizer extends ObjectCollectionDenormalizer
{
    // Do your stuff here
}
```

## Create your own ScalarCollectionDenormalizer

```php
namespace App\Serializer;

use Steevanb\PhpCollection\Bridge\Symfony\Normalizer\ScalarCollectionDenormalizer;

class FooCollectionDenormalizer extends ScalarCollectionDenormalizer
{
    // Do your stuff here
}
```
