<?php

namespace Modules\Base\Services\Concerns;

trait IsReactive
{
    /**
     * @var ?bool
     */
    public ?bool $reactive = null;

    /**
     * @var ?string
     * @example 'name'
     */
    public ?string $reactiveRow = null;

    /**
     * @var string|bool|array|int|null
     * @example 'name'
     */
    public string|bool|array|int|null|object  $reactiveWhere = null;


    /**
     * @return $this
     */
    public function reactive(bool $reactive = true): static
    {
        $this->reactive = $reactive;
        return $this;
    }

    /**
     * @param string $reactiveRow
     * @return $this
     */
    public function reactiveRow(string $reactiveRow): static
    {
        $this->reactiveRow = $reactiveRow;
        return $this;
    }

    /**
     * @param string|bool|array|int|object  $reactiveWhere
     * @return $this
     */
    public function reactiveWhere(string|bool|array|int|object $reactiveWhere): static
    {
        $this->reactiveWhere = $reactiveWhere;
        return $this;
    }
}
