<?php

namespace Modules\Base\Services\Concerns;

trait HasAction
{
    public ?string $action = null;
    public ?string $actionMethod = null;

    /**
     * @param ?string $action
     * @return static
     */
    public function action(?string $action, ?string $actionMethod="post"): static {
        $this->action = $action;
        $this->actionMethod = $actionMethod;
        return $this;
    }
}
