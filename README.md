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
use Arkitect\Expression\ForClasses\IsFinal;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\Rules\Rule;
use Atournayre\PHPArkitect\Builder\RuleBuilder;
use Atournayre\PHPArkitect\Rules\ListenerMustBeLoggableLog;
use Atournayre\PHPArkitect\Set\Sets;

return static function (Config $config): void {
    $classSet = ClassSet::fromDir(__DIR__ . '/src');

    $rules = RulesBuilder::create
        ->add(new ListenerMustBeLoggableLog)
        // Add all rules for Symfony
        ->set(Sets::symfonyCommand())
        // Add subset of rules for Doctrine
        ->set(Sets::doctrineUniformNaming())
        // Add regular rules
        ->add(
            Rule::allClasses()
                ->that(new ResideInOneOfTheseNamespaces('App'))
                ->should(new IsFinal())
                ->because('All classes in App namespace must be final')
        )
        ->rules();

    $config->add($classSet, ...$rules);
};
```
You can use sets or rules individually.


## Contributing

Contributions are welcome!

## License

This project is licensed under the MIT License.
