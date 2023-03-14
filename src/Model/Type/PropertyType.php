<?php

namespace CodeGenerator\Model\Type;

use CodeGenerator\EntityName;

class PropertyType extends Type
{
    public static function createString(bool $canBeNull = false): self
    {
        return new static('string', $canBeNull);
    }

    public static function createInteger(bool $canBeNull = false): self
    {
        return new static('int', $canBeNull);
    }

    public static function createFloat(bool $canBeNull = false): self
    {
        return new static('float', $canBeNull);
    }

    public static function createBoolean(bool $canBeNull = false): self
    {
        return new static('bool', $canBeNull);
    }

    public static function createArray(bool $canBeNull = false): self
    {
        return new static('array', $canBeNull);
    }

    public static function createSelf(bool $canBeNull = false): self
    {
        return new static('self', $canBeNull);
    }

    public static function createObject(EntityName $name, bool $canBeNull = false): self
    {
        return new static($name, $canBeNull);
    }
}
