<?php

namespace CodeGenerator\Model;

use CodeGenerator\Model\Type\Type;
use CodeGenerator\Traits\CanBeAbstract;
use CodeGenerator\Traits\CanBeFinal;
use CodeGenerator\Traits\CanBeStatic;
use CodeGenerator\Traits\HasVisibility;

class Method
{
    use CanBeAbstract, CanBeStatic, CanBeFinal, HasVisibility;

    protected string $name;

    /** @var Argument[] */
    protected array $arguments = [];
    protected ?Type $returnedType = null;

    protected string $body = '';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Argument[] $arguments
     * @return $this
     */
    public function setArguments(array $arguments): self
    {
        $this->arguments = $arguments;

        return $this;
    }

    public function addArgument(Argument $argument): self
    {
        $this->arguments[] = $argument;

        return $this;
    }

    /**
     * @return Argument[]
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getReturnedType(): ?Type
    {
        return $this->returnedType;
    }

    public function setReturnedType(?Type $type): self
    {
        $this->returnedType = $type;

        return $this;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
