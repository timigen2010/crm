<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $category_image_id
 * @property int $category_id
 * @property string $image
 * @property int $image_type
 */
class CategoryImageResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CategoryImageResource",
     *     type="object",
     *    @SWG\Property(property="categoryImageId", type="integer"),
     *    @SWG\Property(property="categoryId", type="integer"),
     *    @SWG\Property(property="image", type="string"),
     *    @SWG\Property(property="imageType", type="boolean"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'categoryId' => $this->category_id,
            'categoryImageId' => $this->category_image_id,
            'image' => $this->image,
            'imageType' => $this->image_type,
        ];
    }
}
