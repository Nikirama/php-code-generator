<?php

namespace CodeGenerator\Traits;

use CodeGenerator\Exception\CodeGeneratorException;

trait CanBeAbstract
{
    protected bool $isAbstract = false;

    /**
     * @throws CodeGeneratorException
     */
    public function makeAbstract(): self
    {
        if (property_exists($this, 'isFinal') && $this->isFinal) {
            throw new CodeGeneratorException('Entity cannot be abstract. It\'s already final');
        } else if (property_exists($this, 'isStatic') && $this->isStatic) {
            throw new CodeGeneratorException('Method cannot be abstract. It\'s already static');
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