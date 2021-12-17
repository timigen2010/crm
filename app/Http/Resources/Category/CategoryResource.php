<?php

namespace App\Http\Resources\Category;

use App\Model\Category\Entity\Category;
use App\Model\Category\Entity\CategoryBadge;
use App\Model\Category\Entity\CategoryDescription;
use App\Model\Category\Entity\CategoryImage;
use App\Model\Menu\Entity\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $category_id
 * @property int $category_badge_id
 * @property bool $status
 * @property CategoryBadge $categoryBadge
 * @property Category $parent
 * @property Collection<CategoryImage> $images
 * @property Collection<CategoryDescription> $descriptions
 * @property Collection<Menu> $menus
 */
class CategoryResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CategoryResource",
     *     type="object",
     *    @SWG\Property(property="categoryId", type="integer"),
     *    @SWG\Property(property="categoryBadgeId", type="integer"),
     *    @SWG\Property(property="parentId", type="integer"),
     *    @SWG\Property(property="status", type="boolean"),
     *    @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="categoryDescriptionId", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="description", type="string"),
     *              @SWG\Property(property="languageId", type="integer"),
     *              @SWG\Property(property="companyId", type="integer"),
     *              @SWG\Property(property="h1Title", type="string"),
     *              @SWG\Property(property="metaTitle", type="string"),
     *              @SWG\Property(property="shortDescription", type="string"),
     *              @SWG\Property(property="metaDescription", type="string"),
     *              @SWG\Property(property="metaKeywords", type="string")
     *          )
     *     ),
     *     @SWG\Property(property="images", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="categoryImageId", type="integer"),
     *              @SWG\Property(property="image", type="string"),
     *              @SWG\Property(property="imageType", type="integer"),
     *          )
     *      ),
     *     @SWG\Property(property="menus", type="array",
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
            'categoryId' => $this->category_id,
            'categoryBadgeId' => $this->category_badge_id,
            'status' => $this->status,
            'parentId' => $this->parent ? $this->parent->category_id : null,
            'descriptions' => $this->descriptions->map(
                function (CategoryDescription $description) {
                    return [
                        'categoryDescriptionId' => $description->category_description_id,
                        'description' => $description->description,
                        'name' => $description->name,
                        'languageId' => $description->language_id,
                        'companyId' => $description->company_id,
                        'h1Title' => $description->h1_title,
                        'metaTitle' => $description->meta_title,
                        'shortDescription' => $description->short_description,
                        'metaDescription' => $description->meta_description,
                        'metaKeywords' => $description->meta_keywords,
                    ];
                }),
            'images' => $this->images->map(
                function (CategoryImage $image) {
                    return [
                        'categoryImageId' => $image->category_image_id,
                        'image' => $image->image,
                        'imageType' => $image->image_type,
                    ];
                }
            ),
            'menus' => $this->menus->map(fn(Menu $menu) => $menu->menu_id)
        ];
    }
}
