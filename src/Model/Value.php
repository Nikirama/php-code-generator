<?php

namespace CodeGenerator\Model;

class Value
{
    /** @var mixed */
    protected $value;
    protected bool $scalar;

    protected function __construct($value, bool $scalar = true)
    {
        $this->value = $value;
        $this->scalar = $scalar;
    }

    public static function createString(string $value): self
    {
        return new static($value);
    }

    public static function createInteger(int $value): self
    {
        return new static($value);
    }

    public static function createFloat(float $value): self
    {
        return new static($value);
    }

    public static function createBoolean(bool $value): self
    {
        return new static($value);
    }

    public static function createArray(array $value): self
    {
        return new static($value);
    }

    public static function createNull(): self
    {
        return new static(null);
    }

    public static function createStaticBind(string $value): self
    {
        // TODO:: validate
        return new static($value, false);
    }

    public static function createConstant(string $value): self
    {
        // TODO:: validate
        return new static($value, false);
    }

    public function isScalar(): bool
    {
        return $this->scalar;
    }

    public function getValue()
    {
        return $this->value;
    }
}
