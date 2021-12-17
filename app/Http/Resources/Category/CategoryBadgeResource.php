<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $category_badge_id
 * @property string $code
 * @property string $image
 */
class CategoryBadgeResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CategoryBadgeResource",
     *     type="object",
     *    @SWG\Property(property="categoryBadgeId", type="integer"),
     *    @SWG\Property(property="code", type="string"),
     *    @SWG\Property(property="image", type="string")
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'categoryBadgeId' => $this->category_badge_id,
            'code' => $this->code,
            'image' => $this->image,
        ];
    }
}
