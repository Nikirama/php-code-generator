<?php

namespace CodeGenerator\Traits;

use CodeGenerator\EntityName;
use CodeGenerator\Exception\ClassGeneratorException;

trait HasInterfaces
{
    /** @var EntityName[] */
    protected array $interfaces = [];

    /**
     * @param EntityName[] $interfaces
     * @return $this
     * @throws ClassGeneratorException
     */
    public function setInterfaces(array $interfaces): self
    {
        foreach ($interfaces as $interface) {
            if (!$interface instanceof EntityName) {
                throw new ClassGeneratorException('Invalid interface');
            } else if (!interface_exists($interface->getFullName())) {
                throw new ClassGeneratorException('Interface doesn\'t exists');
            }
        }

        $this->interfaces = $interfaces;

        return $this;
    }

    /**
     * @throws ClassGeneratorException
     */
    public function addInterface(EntityName $interface): self
    {
        if (!interface_exists($interface->getFullName())) {
            throw new ClassGeneratorException('Interface doesn\'t exists');
        }

        $this->interfaces[] = $interface;

        return $this;
    }

    /**
     * @return EntityName[]
     */
    public function getInterfaces(): array
    {
        return $this->interfaces;
    }
}