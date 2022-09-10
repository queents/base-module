<?php

namespace Modules\Base\Services\Concerns;

trait IsMoney
{
    /**
     * @var ?bool
     */
    public ?bool $money = false;

    /**
     * @return $this
     */
    public function money(bool $money = true): static
    {
        $this->money = $money;
        return $this;
    }
}
