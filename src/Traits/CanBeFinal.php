<?php

namespace CodeGenerator\Traits;

use CodeGenerator\Exception\ClassGeneratorException;

trait CanBeFinal
{
    protected bool $isFinal = false;

    /**
     * @throws ClassGeneratorException
     */
    public function makeFinal(): self
    {
        if (property_exists($this, 'isAbstract') && $this->isAbstract) {
            throw new ClassGeneratorException('Entity cannot be final. It\'s already abstract');
        }

        $this->isFinal = true;

        return $this;
    }

    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    public function removeFinal(): self
    {
        $this->isFinal = false;

        return $this;
    }
}