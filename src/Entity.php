<?php

namespace CodeGenerator;

abstract class Entity
{
    /** @var EntityName[] */
    protected array $uses = [];

    protected EntityName $name;

    /**
     * @param string $name - With namespace
     */
    public function __construct(string $name)
    {
        $this->name = new EntityName($name);
    }

    public function getEntityName(): EntityName
    {
        return $this->name;
    }

    public function getName(): string
    {
        return $this->name->getName();
    }

    public function getNamespace(): string
    {
        return $this->name->getNamespace();
    }

    public function getFullName(): string
    {
        return $this->name->getFullName();
    }
}
