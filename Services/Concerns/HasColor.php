<?php

namespace Modules\Base\Services\Concerns;

trait HasColor
{
    /**
     * @var ?string
     * @example 12
     */
    public ?string $color = null;

    public function color($color): static
    {
        $this->color = $color;
        return $this;
    }
}
