<?php

namespace App\Http\Resources\Product;

use App\Model\Category\Entity\Category;
use App\Model\Menu\Entity\Menu;
use App\Model\Product\Entity\ProductDescription;
use App\Model\Product\Entity\ProductImage;
use App\Model\Product\Entity\ProductType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $product_id
 * @property int $product_type_id
 * @property int $currency_id
 * @property int $unit_class_id
 * @property int $weight_class_id
 * @property int $main_category_id
 * @property string $name
 * @property float $cost_price
 * @property float $price
 * @property float $weight
 * @property float $minimum
 * @property bool $status
 * @property bool $sale_able
 * @property bool $deleted
 * @property int $cooking_time
 * @property Carbon $date_available
 * @property ProductType $productType
 * @property Category $mainCategory
 * @property Collection<ProductDescription> $descriptions
 * @property Collection<ProductImage> $images
 * @property Collection<Menu> $menus
 * @property Collection<Category> $categories
 */
class ProductResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="ProductResource",
     *     type="object",
     *     @SWG\Property(property="productId", type="integer"),
     *     @SWG\Property(property="productTypeId", type="integer"),
     *     @SWG\Property(property="currencyId", type="integer"),
     *     @SWG\Property(property="unitClassId", type="integer"),
     *     @SWG\Property(property="weightClassId", type="integer"),
     *     @SWG\Property(property="mainCategoryId", type="integer"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="costPrice", type="number"),
     *     @SWG\Property(property="price", type="number"),
     *     @SWG\Property(property="weight", type="number"),
     *     @SWG\Property(property="minimum", type="number"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="saleAble", type="boolean"),
     *     @SWG\Property(property="cookingTime", type="integer"),
     *     @SWG\Property(property="dateAvailable", type="string"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="productDescriptionId", type="integer"),
     *              @SWG\Property(property="languageId", type="integer"),
     *              @SWG\Property(property="companyId", type="integer"),
     *              @SWG\Property(property="description", type="string"),
     *              @SWG\Property(property="seoDescription", type="string"),
     *              @SWG\Property(property="metaDescription", type="string"),
     *              @SWG\Property(property="metaTitle", type="string"),
     *              @SWG\Property(property="metaKeywords", type="string"),
     *          )
     *     ),
     *     @SWG\Property(property="images", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="productImageId", type="integer"),
     *              @SWG\Property(property="image", type="string")
     *          )
     *      ),
     *      @SWG\Property(property="categories", type="array",
     *          @SWG\Items(type="integer")
     *      ),
     *      @SWG\Property(property="menus", type="array",
     *          @SWG\Items(type="integer")
     *      )
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
            'currencyId' => $this->currency_id,
            'unitClassId' => $this->unit_class_id,
            'weightClassId' => $this->weight_class_id,
            'mainCategoryId' => $this->main_category_id,
            'name' => $this->name,
            'costPrice' => $this->cost_price,
            'price' => $this->price,
            'weight' => $this->weight,
            'minimum' => $this->minimum,
            'status' => $this->status,
            'saleAble' => $this->sale_able,
            'cookingTime' => $this->cooking_time,
            'dateAvailable' => $this->date_available,
            'descriptions' => $this->descriptions->map(
                function (ProductDescription $description) {
                    return [
                        'productDescriptionId' => $description->product_description_id,
                        'languageId' => $description->language_id,
                        'companyId' => $description->company_id,
                        'description' => $description->description,
                        'seoDescription' => $description->seo_description,
                        'metaDescription' => $description->meta_description,
                        'metaTitle' => $description->meta_title,
                        'metaKeywords' => $description->meta_keywords,
                    ];
                }),
            'images' => $this->images->map(
                function (ProductImage $image) {
                    return [
                        'productImageId' => $image->product_image_id,
                        'image' => $image->image
                    ];
                }
            ),
            'categories' => $this->categories->map(fn (Category $category) => $category->category_id),
            'menus' => $this->menus->map(fn (Menu $menu) => $menu->menu_id),
        ];
    }
}
