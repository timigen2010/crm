<?php

namespace App\Http\Resources\Order;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $current_page
 * @property int $per_page
 * @property int $total
 * @property array $data
 */
class OrdersPaginationResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="OrdersPaginationResource",
     *     type="object",
     *     @SWG\Property(property="currentPage", type="integer"),
     *     @SWG\Property(property="perPage", type="integer"),
     *     @SWG\Property(property="total", type="integer"),
     *     @SWG\Property(property="data", type="array", @SWG\Items(ref="#/definitions/OrdersResource")),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var LengthAwarePaginator $paginator */
        $paginator = $this->resource;
        return [
            'currentPage' => $paginator->currentPage(),
            'perPage' => $paginator->perPage(),
            'total' => $paginator->total(),
            'data' => OrdersResource::collection($paginator->items()),
        ];
    }
}
