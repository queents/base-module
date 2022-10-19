<?php

namespace Modules\Base\Services\Concerns;

trait HasAdd
{
    /**
     * @var string | array | bool | null
     */
    public ?bool $add = null;

    public function add(bool $add=true): static
    {
        $this->add = $add;
        return $this;
    }
}