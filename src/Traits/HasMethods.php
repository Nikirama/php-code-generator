<?php

namespace CodeGenerator\Traits;

use CodeGenerator\Model\Method;

trait HasMethods
{
    /** @var Method[] */
    protected array $methods = [];

    /**
     * @param Method[] $methods
     */
    public function setMethods(array $methods): self
    {
        $this->methods = $methods;

        return $this;
    }

    public function addMethod(Method $method): self
    {
        $this->methods[] = $method;

        return $this;
    }

    /**
     * @return Method[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
}