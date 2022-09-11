<?php

namespace Modules\Base\Services\Resource\Concerns\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Base\Services\Components\Base\Render;

trait Create
{
    public ?string $module = null;

    public function create(Request $request): \Inertia\Response
    {
        /*
         * Check if user has role to create a new record
         */
        if ($this->checkRoles('canCreate') && !$this->isAPI($request)) {
            return $this->checkRoles('canCreate');
        }

        $rows = $this->rows();
        return Render::make(ucfirst(Str::camel($this->table)).'/Create')->module($this->module)->data([
            "rows" => $rows,
            "url" => $this->table
        ])->render();
    }
}
