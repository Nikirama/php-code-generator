<?php

namespace CodeGenerator\Traits;

trait CanBeStatic
{
    protected bool $isStatic = false;

    public function makeStatic(): self
    {
        $this->isStatic = true;

        return $this;
    }

    public function isStatic(): bool
    {
        return $this->isStatic;
    }

    public function removeStatic(): self
    {
        $this->isStatic = false;

        return $this;
    }
}