<?php

namespace Modules\Base\Services\Resource\Concerns\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait GenerateNameHelper
{
    public ?string $table = null;

    public function generateName(bool $single = false, bool $space = false): string
    {
        $explode = explode('_', $this->table);
        $tableName = "";
        $x = 1;
        foreach ($explode as $item) {
            if ($space && $single) {
                if ($x === count($explode)) {
                    $item = Str::singular(Str::ucfirst($item));
                } else {
                    $item = Str::ucfirst($item);
                }
                $tableName .= " " . $item;
                $x++;
            } else {
                $item = Str::ucfirst($item);
                $tableName .= " " . $item;
            }
        }

        return Str::ucfirst($tableName);
    }

    public function paginate($items, $perPage = 10, $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
