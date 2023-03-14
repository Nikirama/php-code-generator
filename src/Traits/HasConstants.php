<?php

namespace CodeGenerator\Traits;

use CodeGenerator\Model\Constant;

trait HasConstants
{
    /** @var Constant[] */
    protected array $constants = [];

    /**
     * @param Constant[] $constants
     */
    public function setConstants(array $constants): self
    {
        $this->constants = $constants;

        return $this;
    }

    public function addConstant(Constant $constant): self
    {
        $this->constants[] = $constant;

        return $this;
    }

    /**
     * @return Constant[]
     */
    public function getConstants(): array
    {
        return $this->constants;
    }
}