<?php

namespace App\Http\Resources\Product;

use App\Model\Category\Entity\Category;
use App\Model\Menu\Entity\Menu;
use App\Model\Product\Entity\ProductType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
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
class ProductsResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="ProductsResource",
     *     type="object",
     *     @SWG\Property(property="productId", type="integer"),
     *     @SWG\Property(property="productTypeId", type="integer"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="price", type="number"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="menuName", type="string"),
     *     @SWG\Property(property="productType", type="string"),
     *     @SWG\Property(property="unitClassId", type="integer"),
     *      @SWG\Property(property="categories", type="array"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'productId' => $this->product_id,
            'productTypeId' => $this->product_type_id,
            'unitClassId' => $this->unit_class_id,
            'name' => $this->name,
            'price' => $this->price,
            'status' => $this->status,
            'menuName' => $this->menus->first() ? $this->menus->first()->name : null,
            'weightClassUnit' => $this->weightClass->descriptions->first() ? $this->weightClass->descriptions->first()->unit : "",
            'categories' => $this->categories,
            'productType' => $this->productType ? $this->productType->type_code : null
        ];
    }
}
