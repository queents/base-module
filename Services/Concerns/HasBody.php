<?php

namespace Modules\Base\Services\Concerns;

trait HasBody
{
    /**
     * @var string | array | bool | null
     */
    public string | array | bool | null  $body = null;

    public function body(string | array | bool | null $body): static
    {
        $this->body = $body;
        return $this;
    }
}
