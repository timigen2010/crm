<?php

namespace App\Http\Resources\Report\ProductComplect;

use App\Model\Menu\Entity\Menu;
use App\Model\Product\Entity\ProductComplect;
use App\Model\Product\Entity\ProductCPFC;
use App\Model\Product\Entity\ProductType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $product_id
 * @property int $product_type_id
 * @property int $unit_class_id
 * @property string $name
 * @property float $price
 * @property bool $status
 * @property Collection<Menu> $menus
 * @property ProductType $productType
 */
class ProductComplectsResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="ProductComplectsResource",
     *     type="object",
     *     @SWG\Property(property="productId", type="integer"),
     *     @SWG\Property(property="productTypeId", type="integer"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="price", type="number"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="menuName", type="string"),
     *     @SWG\Property(property="productType", type="string"),
     *     @SWG\Property(property="unitClassId", type="integer"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'productId' => $this->product_id,
            'name' => $this->name,
            'weight' => $this->weight,
            'weight_class_id' => $this->weight_class_id,
            'cooking_time' => $this->cooking_time,
            'sale_able' => $this->sale_able,
            'materials' => ($this->complects) ? $this->complects->map(function ($complect){
                return [
                    'productId' => $complect->material_id,
                    'name' => $complect->material->name,
                    'amount' => $complect->amount,
                    'unit_class_description' => $complect->unitClass ? $complect->unitClass->getDescription() : [],
                    'unit_class_id' => $complect->unit_class_id,
                    'sale_able' => $complect->material->sale_able,
                    'cpfc' => ($complect->material->cpfc) ? [
                        'calories' => $complect->material->cpfc->calories,
                        'protein' => $complect->material->cpfc->protein,
                        'fat' => $complect->material->cpfc->fat,
                        'carbs' => $complect->material->cpfc->carbs
                    ] : [
                        'calories' => 0,
                        'protein' => 0,
                        'fat' => 0,
                        'carbs' => 0
                    ]
                ];
            }) : [],
            'cpfc' => ($this->cpfc) ? [
                'calories' => $this->cpfc->calories,
                'protein' => $this->cpfc->protein,
                'fat' => $this->cpfc->fat,
                'carbs' => $this->cpfc->carbs
            ] : [
                'calories' => 0,
                'protein' => 0,
                'fat' => 0,
                'carbs' => 0
            ]
        ];
    }
}
