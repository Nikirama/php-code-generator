<?php

namespace CodeGenerator\Model;

use CodeGenerator\Model\Type\PropertyType;
use CodeGenerator\Traits\CanBeStatic;
use CodeGenerator\Traits\HasVisibility;

class Property
{
    use CanBeStatic, HasVisibility;

    protected string $name;
    protected ?PropertyType $type = null;
    protected ?Value $defaultValue = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): ?PropertyType
    {
        return $this->type;
    }

    public function setType(?PropertyType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setDefaultValue(?Value $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function getDefaultValue(): ?Value
    {
        return $this->defaultValue;
    }
}
