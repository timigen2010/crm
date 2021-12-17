<?php

namespace App\Http\Resources\Product;

use App\Model\Product\Entity\ProductCPFC;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property ProductCPFC $cpfc
 */
class ProductsCPFCResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="ProductsCPFCResource",
     *     type="object",
     *     @SWG\Property(property="productId", type="integer"),
     *     @SWG\Property(property="calories", type="float"),
     *     @SWG\Property(property="protein", type="float"),
     *     @SWG\Property(property="fat", type="float"),
     *     @SWG\Property(property="carbs", type="float"),
     * )
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'productId' => $this->product_id,
            'calories' => $this->calories,
            'protein' => $this->protein,
            'fat' => $this->fat,
            'carbs' => $this->carbs
        ];
    }
}
