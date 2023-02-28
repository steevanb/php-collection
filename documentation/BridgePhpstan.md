## Installation

Add bridge to your autoload into `composer.json`:
```json
{
    "autoload": {
        "psr-4": {
            "steevanb\\PhpCollection\\Bridge\\Phpstan\\": "vendor/steevanb/php-collection/bridge/Phpstan/src"
        }
    }
}
```

Add rules to your `phpstan.neon`:
```yaml
includes:
    - vendor/steevanb/php-collection/bridge/Phpstan/rules.neon
```

## Rules

### DisallowTypedArrayRule

See [Limitations](Limitations.md) to understand this rule.

It disallow `foreach` with `TypedArrayInterface` directly.

phpstan level: `2`.
