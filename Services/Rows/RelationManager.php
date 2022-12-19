<?php

namespace Modules\Base\Services\Rows;

use Modules\Base\Services\Concerns\HasResource;
use Modules\Base\Services\Rows\Abstracts\Base;

class RelationManager extends Base
{
    use HasResource;

    public string $vue = "ViltRelationManager.vue";

    /**
     * @param string $name
     * @return static
     */
    public static function make(string $name): self
    {
        return (new self)->name($name);
    }
}
