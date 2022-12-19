<?php

namespace Modules\Base\Services\Concerns;

trait HasResource
{
    /**
     * @var ?array
     * @example 'groupId'
     */
    public ?array $resource = null;

    /**
     * @param ?string $resource
     * @return $this
     */
    public function resource(?string $resource): static
    {
        $data = app($resource)->query(request(), $this->rows, false);
        $this->resource = app($resource)->response($this->rows, $data, app($resource)->table);
        return $this;
    }
}
