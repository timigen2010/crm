<?php

namespace App\Http\Resources\Category;

use App\Model\Category\Entity\CategoryDescription;
use App\Model\Menu\Entity\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $category_id
 * @property Collection<CategoryDescription> $descriptions
 * @property Collection<Menu> $menus
 * @method getName(?int $languageId = null)
 */
class CategoriesResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CategoriesResource",
     *     type="object",
     *    @SWG\Property(property="categoryId", type="integer"),
     *    @SWG\Property(property="name", type="string"),
     *    @SWG\Property(property="menuName", type="string"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'categoryId' => $this->category_id,
            'name' => $this->getName($request->query->get('languageId')),
            'menuName' => $this->menus->first() ? $this->menus->first()->name : null,
            'parentId' => $this->parent_id
        ];
    }
}
