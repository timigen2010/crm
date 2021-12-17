<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Resources\Product\ProductTypeResource;
use App\Model\Product\Service\ProductType\Get\GetProductTypesInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class ProductTypeController extends BaseController
{
    private GetProductTypesInterface $getProductTypes;

    public function __construct(GetProductTypesInterface $getProductTypes)
    {
        $this->getProductTypes = $getProductTypes;
    }

    /**
     * @SWG\Get(
     *     path="api/products/types",
     *     tags={"Products"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all types",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/ProductTypeResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return AnonymousResourceCollection
     */
    public function getProductTypesAction()
    {
        return ProductTypeResource::collection($this->getProductTypes->get());
    }
}
