# phparkitect rules

The project is structured around the concept of architectural rules for PHP classes, with a focus on namespace dependencies and class naming conventions.

## Installing

```bash
composer require --dev atournayre/phparkitect-rules
```

## Usage

Rules must be used in a phparkitect configuration file.

Here is an example of how to use it:

```php
// phparkitect.php
use Arkitect\ClassSet;
use Arkitect\CLI\Config;
use Atournayre\PHPArkitect\Rule\LogRule;
use Atournayre\PHPArkitect\Rule\MiscRule;
use Atournayre\PHPArkitect\Set\Sets;

return static function (Config $config): void {
    $classSet = ClassSet::fromDir(__DIR__ . '/src');

    // Add all rules for API Platform    
    $config->add($classSet, ...Sets::apiPlatform());
    // Add all rules for Symfony
    $config->add($classSet, ...Sets::symfony());
    // Add subset of rules for Doctrine
    $config->add($classSet, ...Sets::doctrineUniformNaming());
    // Add specific rules
    $config->add(
        $classSet,
        LogRule::listenerMustBeLoggable(),
        MiscRule::dtoMustNotEndWithDto(),
        MiscRule::traits(),
    );
};
```
You can use sets or rules individually.


## Contributing

Contributions are welcome!

## License

This project is licensed under the MIT License.
