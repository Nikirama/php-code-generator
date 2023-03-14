<?php

namespace CodeGenerator;

use CodeGenerator\Exception\ClassGeneratorException;
use CodeGenerator\Traits\CanBeAbstract;
use CodeGenerator\Traits\CanBeFinal;
use CodeGenerator\Traits\HasConstants;
use CodeGenerator\Traits\HasInterfaces;
use CodeGenerator\Traits\HasMethods;
use CodeGenerator\Traits\HasProperties;
use CodeGenerator\Traits\HasTraits;

class ClassGenerator extends Entity
{
    use CanBeAbstract, CanBeFinal, HasInterfaces, HasTraits, HasConstants, HasProperties, HasMethods;

    protected ?EntityName $parent = null;

    /**
     * @throws ClassGeneratorException
     */
    public function setParent(?EntityName $parent): self
    {
        if ($parent !== null && !class_exists($parent->getFullName())) {
            throw new ClassGeneratorException('Parent class doesn\'t exists');
        }

        $this->parent = $parent;

        return $this;
    }

    public function hasParent(): bool
    {
        return $this->parent !== null;
    }

    public function getParent(): ?EntityName
    {
        return $this->parent;
    }
}