<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Resources\Category\CategoriesResource;
use App\Http\Resources\Product\ProductsResource;
use App\Model\Category\Service\Get\GetCategoriesInterface;
use App\Model\Menu\Entity\Menu;
use App\Model\Product\Service\Get\GetProductsInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class CategoryMenuController extends BaseController
{
    private GetCategoriesInterface $getCategoriesByMenu;

    public function __construct(GetCategoriesInterface $getCategories)
    {
        $this->getCategoriesByMenu = $getCategories;
    }

    /**
     * @SWG\Get(
     *     path="api/categories/by_menu/{menu_id}",
     *     tags={"Categories"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all categories by menu",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/CategoriesResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Menu $menu
     * @return AnonymousResourceCollection
     */
    public function getCategoriesByMenuAction(Menu $menu)
    {
        return CategoriesResource::collection($this->getCategoriesByMenu->getCategories($menu->menu_id));
    }
}
