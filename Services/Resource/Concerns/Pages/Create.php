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
        $rows = $this->rows();
        return Render::make(Str::ucfirst($this->table).'/Create')->module($this->module)->data([
            "rows" => $rows,
            "url" => $this->table
        ])->render();
    }
}
