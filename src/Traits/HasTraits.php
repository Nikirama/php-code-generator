<?php

namespace CodeGenerator\Traits;

use CodeGenerator\EntityName;
use CodeGenerator\Exception\CodeGeneratorException;

trait HasTraits
{
    /** @var EntityName[] */
    protected array $traits = [];

    /**
     * @param EntityName[] $traits
     * @return $this
     * @throws CodeGeneratorException
     */
    public function setTraits(array $traits): self
    {
        foreach ($traits as $trait) {
            if (!$trait instanceof EntityName) {
                throw new CodeGeneratorException('Invalid trait');
            } else if (!trait_exists($trait->getFullName())) {
                throw new CodeGeneratorException('Trait doesn\'t exists');
            }
        }

        $this->traits = $traits;

        return $this;
    }

    /**
     * @throws CodeGeneratorException
     */
    public function addTrait(EntityName $trait): self
    {
        if (!trait_exists($trait->getFullName())) {
            throw new CodeGeneratorException('Trait doesn\'t exists');
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