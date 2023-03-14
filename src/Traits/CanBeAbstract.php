<?php

namespace CodeGenerator\Traits;

use CodeGenerator\Exception\ClassGeneratorException;

trait CanBeAbstract
{
    protected bool $isAbstract = false;

    /**
     * @throws ClassGeneratorException
     */
    public function makeAbstract(): self
    {
        if (property_exists($this, 'isFinal') && $this->isFinal) {
            throw new ClassGeneratorException('Entity cannot be abstract. It\'s already final');
        } else if (property_exists($this, 'isStatic') && $this->isStatic) {
            throw new ClassGeneratorException('Method cannot be abstract. It\'s already static');
        }

        $this->isAbstract = true;

        return $this;
    }

    public function isAbstract(): bool
    {
        return $this->isAbstract;
    }

    public function removeAbstract(): self
    {
        $this->isAbstract = false;

        return $this;
    }
}