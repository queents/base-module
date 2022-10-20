<?php

namespace Modules\Base\Services\Concerns;

trait HasApi
{
    /**
     * @var ?string
     */
    public ?string $apiRow = null;
    /**
     * @var ?string
     */
    public ?string $apiModel = null;
    /**
     * @var ?string
     */
    public ?string $apiLabel = null;
    /**
     * @var ?string
     */
    public ?string $apiQuery = null;

    public function api(string | null $apiRow, string | null $apiModel,string | null $apiLabel=null, string | null $apiQuery=null): static
    {
        $this->apiRow = $apiRow;
        $this->apiModel = $apiModel;
        $this->apiLabel = $apiLabel;
        $this->apiQuery = $apiQuery;
        return $this;
    }
}
