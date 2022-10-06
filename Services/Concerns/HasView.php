<?php

namespace Modules\Base\Services\Concerns;

trait HasView
{
    /**
     * @var string | null
     */
    public string | null  $viewType = "input";

    public function viewType(string | null $viewType): static
    {
        $this->viewType = $viewType;
        return $this;
    }
}
