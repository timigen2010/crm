<?php

namespace App\Http\Resources\Order;

use App\Model\Order\Service\Get\GetByParams\ResponseOrderTotal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Swagger\Annotations as SWG;

/**
 * @property int $orderId;
 * @property int $orderStatusId;
 * @property int $userId;
 * @property string $deliveryMethod;
 * @property string $firstName;
 * @property string $statusName;
 * @property float $subTotal;
 * @property float $cash;
 * @property float $discount;
 * @property float $total;
 * @property string $createdAt;
 * @property string $updatedAt;
 */
class OrdersResource extends JsonResource
{

    /**
     * @SWG\Definition(
     *     definition="OrdersResource",
     *     type="object",
     *     @SWG\Property(property="orderId", type="integer"),
     *     @SWG\Property(property="orderStatusId", type="integer"),
     *     @SWG\Property(property="userId", type="integer"),
     *     @SWG\Property(property="deliveryMethod", type="string"),
     *     @SWG\Property(property="firstName", type="string"),
     *     @SWG\Property(property="statusName", type="string"),
     *     @SWG\Property(property="subTotal", type="number"),
     *     @SWG\Property(property="cash", type="number"),
     *     @SWG\Property(property="discount", type="number"),
     *     @SWG\Property(property="total", type="number"),
     *     @SWG\Property(property="createdAt", type="string"),
     *     @SWG\Property(property="updatedAt", type="string"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'orderId' => $this->orderId,
            'orderStatusId' => $this->orderStatusId,
            'userId' => $this->userId,
            'deliveryMethod' => $this->deliveryMethod,
            'firstName' => $this->firstName,
            'statusName' => $this->statusName,
            'subTotal' => $this->subTotal,
            'cash' => $this->cash,
            'discount' => $this->discount,
            'total' => $this->total,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
