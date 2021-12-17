<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $product_image_id
 * @property int $product_id
 * @property string $image
 */
class ProductImageResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="ProductImageResource",
     *     type="object",
     *    @SWG\Property(property="productImageId", type="integer"),
     *    @SWG\Property(property="productId", type="integer"),
     *    @SWG\Property(property="image", type="string"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'productId' => $this->product_id,
            'productImageId' => $this->product_image_id,
            'image' => $this->image,
        ];
    }
}
