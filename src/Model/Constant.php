<?php

namespace CodeGenerator\Model;

use CodeGenerator\Traits\HasVisibility;

class Constant
{
    use HasVisibility;

    private string $name;
    private Value $value;

    public function __construct(string $name, Value $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): Value
    {
        return $this->value;
    }
}
