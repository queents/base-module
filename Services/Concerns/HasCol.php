<?php

namespace Modules\Base\Services\Concerns;

trait HasCol
{
    /**
     * @var int
     * @example 12
     */
    public int $col = 12;

    /**
     * @param int $col
     * @return $this
     */
    public function col(int $col): static
    {
        $this->col = $col;
        return $this;
    }
}
