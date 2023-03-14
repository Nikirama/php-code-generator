<?php

namespace CodeGenerator;

use Brick\VarExporter\ExportException;
use Brick\VarExporter\VarExporter;
use CodeGenerator\Model\Argument;
use CodeGenerator\Model\Constant;
use CodeGenerator\Model\Method;
use CodeGenerator\Model\Property;
use CodeGenerator\Model\Type\Type;
use CodeGenerator\Model\Value;

class Printer
{
    protected ClassGenerator $entity;

    private string $tabulation;

    /** @var EntityName[] */
    protected array $uses = [];

    public function __construct(ClassGenerator $entity, string $tabulation = "\t")
    {
        $this->entity = $entity;
        $this->tabulation = $tabulation;
    }

    /**
     * @throws ExportException
     */
    public function generate(): string
    {
        $result = "<?php\n\n";

        if (strlen($this->entity->getNamespace())) {
            $result .= "namespace {$this->entity->getNamespace()};\n\n";
        }

        $result .= '<<<<<#USES#>>>>>';

        if ($this->entity->isAbstract()) {
            $result .= 'abstract ';
        } else if ($this->entity->isFinal()) {
            $result .= 'final ';
        }

        $result .= "class {$this->entity->getName()}";

        if ($this->entity->hasParent()) {
            $this->addUse($this->entity->getParent());
            $result .= " extends {$this->entity->getParent()->getName()}";
        }

        $interfaces = $this->entity->getInterfaces();
        if (count($interfaces)) {
            $result .= ' implements ' . implode(', ', array_map(function ($interface) {
                $this->addUse($interface);
                return $interface->getName();
            }, $interfaces));
        }

        $result .= "\n{\n";

        $traits = $this->entity->getTraits();
        if ($traits) {
            $result .= "{$this->tabulation}use " . implode(', ', array_map(function ($trait) {
                $this->addUse($trait);
                return $trait->getName();
            }, $traits)) . ";\n\n";
        }

        $constants = $this->entity->getConstants();
        if (count($constants)) {
            foreach ($constants as $constant) {
                $result .= $this->generateConstant($constant);
            }
            $result .= "\n";
        }

        $properties = $this->entity->getProperties();
        if (count($properties)) {
            foreach ($properties as $property) {
                $result .= $this->generateProperty($property);
            }
            $result .= "\n";
        }

        $methods = $this->entity->getMethods();
        if (count($methods)) {
            foreach ($methods as $method) {
                $result .= $this->generateMethod($method);
            }
        }

        $result = str_replace('<<<<<#USES#>>>>>', $this->generateUses(), $result);

        return "$result}\n";
    }

    /**
     * @throws ExportException
     */
    protected function generateValue(Value $value): string
    {
        return $value->isScalar() ? VarExporter::export($value->getValue()) : $value->getValue();
    }

    protected function generateType(Type $type): string
    {
        $result = '';

        if ($type->canBeNull()) {
            $result .= '?';
        }

        if ($type->getName() instanceof EntityName) {
            $this->addUse($type->getName());
            $result .= $type->getName()->getName();
        } else {
            $result .= $type->getName();
        }

        return $result;
    }

    /**
     * @throws ExportException
     */
    protected function generateConstant(Constant $constant): string
    {
        return "$this->tabulation{$constant->getVisibility()} const {$constant->getName()} = {$this->generateValue($constant->getValue())};\n";
    }

    /**
     * @throws ExportException
     */
    public function generateProperty(Property $property): string
    {
        $result = "$this->tabulation{$property->getVisibility()} ";

        if ($property->isStatic()) {
            $result .= 'static ';
        }

        if ($property->getType() !== null) {
            $result .= "{$this->generateType($property->getType())} ";
        }

        $result .= "\${$property->getName()}";

        if ($property->getDefaultValue() !== null) {
            $result .= ' = ' . $this->generateValue($property->getDefaultValue());
        }

        return "$result;\n";
    }

    /**
     * @throws ExportException
     */
    public function generateMethod(Method $method): string
    {
        $result = $this->tabulation;

        if ($method->isFinal()) {
            $result .= 'final ';
        } else if ($method->isAbstract()) {
            $result .= 'abstract ';
        }

        if ($method->isStatic()) {
            $result .= 'static ';
        }

        $result .= "{$method->getVisibility()} function {$method->getName()}(";
        $result .= implode(', ', array_map(
            fn ($argument) => $this->generateArgument($argument),
            $method->getArguments()
        ));
        $result .= ")";

        if ($method->getReturnedType() !== null) {
            $result .= ": {$this->generateType($method->getReturnedType())}";
        }

        $result .= "\n$this->tabulation{\n$this->tabulation$this->tabulation{$method->getBody()}\n$this->tabulation}\n";

        return $result;
    }

    /**
     * @throws ExportException
     */
    public function generateArgument(Argument $argument): string
    {
        $result = '';

        if ($argument->getType() !== null) {
            $result .= "{$this->generateType($argument->getType())} ";
        }

        $result .= "\${$argument->getName()}";

        if ($argument->getDefaultValue() !== null) {
            $result .= " = {$this->generateValue($argument->getDefaultValue())}";
        }

        return $result;
    }

    public function addUse(EntityName $entityName): self
    {
        if ($entityName->getName() === $this->entity->getName()) {
            $entityName->setAlias("Base{$this->entity->getName()}");
        }

        while (isset($this->uses[$entityName->getName()]) && $this->uses[$entityName->getName()]->getFullName() !== $entityName->getFullName()) {
            $entityName->setAlias(uniqid('Alias') . "_{$entityName->getName()}");
        }

        $this->uses[$entityName->getName()] = $entityName;

        return $this;
    }

    protected function generateUses(): string
    {
        $result = '';
        foreach ($this->uses as $use) {
            $result .= "use {$use->getFullName()}";
            if ($use->hasAlias()) {
                $result .= " as {$use->getAlias()}";
            }
            $result .= ";\n";
        }
        return $result . (strlen($result) ? "\n" : '');
    }
}