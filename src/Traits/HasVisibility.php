<?php

namespace CodeGenerator\Traits;

trait HasVisibility
{
    protected string $visibility = 'public';

    public function getVisibility(): string
    {
        return $this->visibility;
    }

    public function makePrivate(): self
    {
        $this->visibility = 'private';

        return $this;
    }

    public function makeProtected(): self
    {
        $this->visibility = 'protected';

        return $this;
    }

    public function makePublic(): self
    {
        $this->visibility = 'public';

        return $this;
    }
}