# phparkitect rules

The project is structured around the concept of architectural rules for PHP classes, with a focus on namespace dependencies and class naming conventions.

## Installing

```bash
composer require --dev atournayre/phparkitect-rules
```

## Usage

Rules must be used un phparkitect configuration file.

Here is an example of how to use it:

```php
// phparkitect.php
use Arkitect\ClassSet;
use Arkitect\CLI\Config;

return static function (Config $config): void {
    $classSet = ClassSet::fromDir(__DIR__ . '/src');
    
    $rules = \Atournayre\PHPArkitect\Sets::symfonyApiPlatform();
    $rules[] = \Atournayre\PHPArkitect\Rule::uniformNamingForService();
  
    $config
        ->add($classSet, ...$rules);
};
```

## Contributing

Contributions are welcome!

## License

This project is licensed under the MIT License.
