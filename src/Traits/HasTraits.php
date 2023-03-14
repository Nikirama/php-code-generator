<?php

namespace CodeGenerator\Traits;

use CodeGenerator\EntityName;
use CodeGenerator\Exception\ClassGeneratorException;

trait HasTraits
{
    /** @var EntityName[] */
    protected array $traits = [];

    /**
     * @param EntityName[] $traits
     * @return $this
     * @throws ClassGeneratorException
     */
    public function setTraits(array $traits): self
    {
        foreach ($traits as $trait) {
            if (!$trait instanceof EntityName) {
                throw new ClassGeneratorException('Invalid trait');
            } else if (!trait_exists($trait->getFullName())) {
                throw new ClassGeneratorException('Trait doesn\'t exists');
            }
        }

        $this->traits = $traits;

        return $this;
    }

    /**
     * @throws ClassGeneratorException
     */
    public function addTrait(EntityName $trait): self
    {
        if (!trait_exists($trait->getFullName())) {
            throw new ClassGeneratorException('Trait doesn\'t exists');
        }

        $this->traits[] = $trait;

        return $this;
    }

    /**
     * @return EntityName[]
     */
    public function getTraits(): array
    {
        return $this->traits;
    }
}