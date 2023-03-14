<?php

namespace CodeGenerator\Model;

use CodeGenerator\Model\Type\Type;

class Argument
{
    private string $name;

    private ?Type $type = null;
    private ?Value $defaultValue = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDefaultValue(): ?Value
    {
        return $this->defaultValue;
    }

    public function setDefaultValue(?Value $value): self
    {
        $this->defaultValue = $value;

        return $this;
    }
}
