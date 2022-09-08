<?php

namespace Modules\Base\Services\Resource\Concerns\Handlers;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait Response
{
    public ?string $view = "Resource";

    public function loadResponse(array $rows, LengthAwarePaginator $data, bool $isAPI): JsonResponse | \Inertia\Response
    {
        if ($isAPI) {
            return response()->json([
                "success" => true,
                "message" => __((new self)->generateName(true, true) . ' Loaded Success'),
                "data" => $data
            ]);
        }

        return inertia($this->view, $this->response($rows, $data, $this->table));
    }

    public function response(array $rows, LengthAwarePaginator $data, string $url, array $extra = []): array
    {
        $response = [
            "collection" => $data,
            "rows" => $rows,
            "roles" => [
                "view" => $this->canView,
                "viewAny" => $this->canViewAny,
                "edit" => $this->canEdit,
                "create" => $this->canCreate,
                "delete" => $this->canDelete,
                "deleteAny" => $this->canDeleteAny,
            ],
            "list" => [
                "url" => $url,
                "model" => $this->model,
                "search" => $this->search,
                "per_page" => $this->per_page,
                "orderBy" => $this->orderBy,
                "desc" => $this->orderDirection,
                "filters" => $this->filters,
            ],
            "render" => [
                "create" => $this->create,
                "components" => $this->components(),
                "lang" => $this->loadTranslations(),
                "form" => $this->form(),
                "table" => $this->table()
            ]
        ];

        return array_merge($response, $extra);
    }
}
