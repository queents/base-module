<?php

namespace Modules\Base\Services\Concerns;

trait IsConfirmed
{
    /**
     * @var ?bool
     */
    public ?bool $confirmed = false;

    /**
     * @return $this
     */
    public function confirmed(bool $confirmed = true): static
    {
        $this->confirmed = $confirmed;
        return $this;
    }
}
