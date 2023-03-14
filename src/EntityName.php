<?php

namespace CodeGenerator;

class EntityName
{
    protected string $name;
    protected string $namespace;
    private ?string $alias = null;

    /**
     * @param string $name - With namespace
     */
    public function __construct(string $name)
    {
        if ($name[0] === '\\') {
            $name = substr($name, 1);
        }
        $namespaces = explode('\\', $name);

        $this->name = array_pop($namespaces);
        $this->namespace = implode('\\', $namespaces);
    }

    public function getName(): string
    {
        return $this->alias ?? $this->name;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getFullName(): string
    {
        return ($this->namespace ? "$this->namespace\\" : '') . $this->name;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function hasAlias(): bool
    {
        return isset($this->alias);
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }
}
