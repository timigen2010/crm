<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $product_type_id
 * @property string $type_code
 */
class ProductTypeResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="ProductTypeResource",
     *     type="object",
     *     @SWG\Property(property="productTypeId", type="integer"),
     *     @SWG\Property(property="typeCode", type="integer"),
     * )
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'productTypeId' => $this->product_type_id,
            'typeCode' => $this->type_code
        ];
    }
}
