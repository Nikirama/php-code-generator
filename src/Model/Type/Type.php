<?php

namespace CodeGenerator\Model\Type;

use CodeGenerator\EntityName;

abstract class Type
{
    /** @var EntityName|string */
    protected $name;
    protected bool $canBeNull;

    /**
     * @param string|EntityName $name
     */
    protected function __construct($name, bool $canBeNull = false)
    {
        $this->name = $name;
        $this->canBeNull = $canBeNull;
    }

    public function getName()
    {
        return $this->name;
    }

    public function canBeNull(): bool
    {
        return $this->canBeNull;
    }
}
