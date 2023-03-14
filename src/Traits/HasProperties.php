<?php

namespace CodeGenerator\Traits;

use CodeGenerator\Model\Property;

trait HasProperties
{
    /** @var Property[] */
    protected array $properties = [];

    /**
     * @param Property[] $properties
     * @return $this
     */
    public function setProperties(array $properties): self
    {
        $this->properties = $properties;

        return $this;
    }

    public function addProperty(Property $property): self
    {
        $this->properties[] = $property;

        return $this;
    }

    /**
     * @return Property[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }
}