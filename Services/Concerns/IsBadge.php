<?php

namespace Modules\Base\Services\Concerns;

trait IsBadge
{
    /**
     * @var ?bool
     */
    public ?bool $badge = false;

    /**
     * @return $this
     */
    public function badge(bool $badge = true): static
    {
        $this->badge = $badge;
        return $this;
    }
}
