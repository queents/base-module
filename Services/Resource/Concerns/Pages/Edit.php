<?php

namespace Modules\Base\Services\Resource\Concerns\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Base\Services\Components\Base\Render;

trait Edit
{
    public function edit(Request $request, $id): \Inertia\Response
    {
        $rows = $this->rows();
        $record = $this->model::find($id);
        return Render::make(Str::ucfirst($this->table).'/Edit')->module($this->module)->data([
            "rows" => $rows,
            "record" => $record,
            "url" => $this->table
        ])->render();
    }
}
