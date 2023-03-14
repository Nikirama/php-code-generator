<?php

namespace CodeGenerator\Model\Type;

class MethodType extends PropertyType
{
    public static function createCallable(bool $canBeNull = false): self
    {
        return new static('callable', $canBeNull);
    }
}
