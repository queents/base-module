<?php

namespace Modules\Base\Services\Resource\Concerns\Core;

use Illuminate\Support\Str;

trait Menu
{
    public ?int $sorting = 1;
    public ?bool $menu = true;

    /**
     * @return array
     */
    public function menus(): array
    {
        if ($this->menu) {
            $menus = [
                \Modules\Base\Services\Components\Base\Menu::make(Str::ucfirst($this->table))
                    ->label($this->table . '.sidebar')
                    ->icon($this->icon)
                    ->route($this->table . '.index')
                    ->group($this->group)
                    ->can('view_any_' . $this->table)
                    ->sort($this->sorting)
            ];
        } else {
            $menus = [];
        }

        return array_merge($menus, $this->menu());
    }


    /**
     * @return array
     */
    public function menu(): array
    {
        return [];
    }
}
