<?php

namespace CodeGenerator;

use CodeGenerator\Traits\HasMethods;
use CodeGenerator\Traits\HasProperties;
use CodeGenerator\Traits\HasTraits;

class TraitGenerator extends Entity
{
    use HasTraits, HasProperties, HasMethods;
}