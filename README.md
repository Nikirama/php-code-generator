# CodeGenerator

CodeGenerator is a library, that allows you to describe PHP code by classes, interfaces and traits
I'll give you some examples with classes

## Installation

Install using [Composer](https://getcomposer.org/download):

    composer require nikirama/php-code-generator

## Simple example

```php
<?php require __DIR__ . '/vendor/autoload.php';

use CodeGenerator\ClassGenerator;
use CodeGenerator\Model\Argument;
use CodeGenerator\Model\Method;
use CodeGenerator\Model\Property;
use CodeGenerator\Printer;

$class = (new ClassGenerator('CodeGenerator\\Classes\\NewClass'))
    ->addProperty(new Property('property1'))
    ->addMethod(
        (new Method('__construct'))
            ->addArgument(new Argument('arg1'))
            ->setBody('$this->property1 = $arg1;')
    )
;

echo (new Printer($class))->generate();
```

With this simple example, we get the following output:

```php
<?php

namespace CodeGenerator\Classes;

class NewClass
{
    public $property1;

    public function __construct($arg1)
    {
        $this->property1 = $arg1;
    }
}

```


## Advanced example

```php
<?php require __DIR__ . '/vendor/autoload.php';

use CodeGenerator\ClassGenerator;
use CodeGenerator\EntityName;
use CodeGenerator\Model\Argument;
use CodeGenerator\Model\Constant;
use CodeGenerator\Model\Method;
use CodeGenerator\Model\Property;
use CodeGenerator\Model\Type\MethodType;
use CodeGenerator\Model\Type\PropertyType;
use CodeGenerator\Model\Value;
use CodeGenerator\Printer;

$class = (new ClassGenerator('CodeGenerator\\Classes\\NewClass'))
    ->setParent(new EntityName('Exception'))
    ->addInterface(new EntityName('Throwable'))
    ->setTraits([
        new EntityName('Trait1'),
        new EntityName('Trait2'),
    ])
    ->addConstant(
        (new Constant('CODES_LIST', Value::createArray([400, 401, 404])))
            ->makeProtected()
    )
    ->setProperties([
        (new Property('status'))
            ->makeStatic()
            ->makePrivate(),
        (new Property('message'))
            ->makeProtected()
            ->setType(PropertyType::createString())
            ->setDefaultValue(Value::createString('Something went wrong :(')),
    ])
    ->addMethod(
        (new Method('create'))
            ->makeFinal()
            ->makePublic()
            ->makeStatic()
            ->setArguments([
                (new Argument('reference'))
                    ->setType(MethodType::createObject(new EntityName('\Protobuf\Exception'))),
                (new Argument('message'))
                    ->setType(MethodType::createString(true))
                    ->setDefaultValue(Value::createNull()),
            ])
            ->setReturnedType(MethodType::createSelf(true))
            ->setBody('return $message ? new self($message) : null;')
    )
;

echo (new Printer($class))->generate();
```

With this simple example, we get the following output:

```php
<?php

namespace CodeGenerator\Classes;

use Exception;
use Throwable;
use Trait1;
use Trait2;
use Protobuf\Exception as Alias6410c5d162e78_Exception;

class NewClass extends Exception implements Throwable
{
    use Trait1, Trait2;

    protected const CODES_LIST = [
        400,
        401,
        404
    ];

    private static $status;
    protected string $message = 'Something went wrong :(';

    final static public function create(?string $message = null, Alias6410c5d162e78_Exception $reference): ?self
    {
        return $message ? new self($message) : null;
    }
}
```
