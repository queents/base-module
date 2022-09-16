<?php

namespace Modules\Base\Services\Concerns;

trait IsUrl
{
    /**
     * @var ?bool
     */
    public ?bool $url = false;

    /**
     * @return $this
     */
    public function url(bool $url = true): static
    {
        $this->url = $url;
        return $this;
    }
}
