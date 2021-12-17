<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Resources\Product\ProductsResource;
use App\Model\Menu\Entity\Menu;
use App\Model\Product\Service\Get\GetProductsInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class ProductMenuController extends BaseController
{
    private GetProductsInterface $getProductsByMenu;

    public function __construct(GetProductsInterface $getProducts)
    {
        $this->getProductsByMenu = $getProducts;
    }

    /**
     * @SWG\Get(
     *     path="api/products/by_menu/{menu_id}",
     *     tags={"Products"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all products by menu",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/ProductsResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Menu $menu
     * @return AnonymousResourceCollection
     */
    public function getProductsByMenuAction(Menu $menu)
    {
        return ProductsResource::collection($this->getProductsByMenu->getProducts($menu->menu_id));
    }
}
