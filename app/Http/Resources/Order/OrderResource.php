<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $order_id
*/
class OrderResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="OrderResource",
     *     type="object",
     *     @SWG\Property(property="orderId", type="integer")
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "orderId" => $this->order_id
        ];
    }
}
