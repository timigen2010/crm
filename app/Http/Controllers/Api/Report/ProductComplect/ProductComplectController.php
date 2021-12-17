<?php

namespace App\Http\Controllers\Api\Report\ProductComplect;

use App\Http\Requests\Product\GetProductsRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Report\ProductComplect\GetProductComplectsRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductsResource;
use App\Http\Resources\Report\ProductComplect\ProductComplectsResource;
use App\Model\Product\Entity\Product;
use App\Model\Product\Entity\ProductComplect;
use App\Model\Product\Service\Delete\ProductDeleteInterface;
use App\Model\Product\Service\Factory\Data as ProductFactoryData;
use App\Model\Product\Service\Get\GetProductsInterface;
use App\Model\Product\Service\Get\GetProductsByParams\Data as GetProductsByParamsData;
use App\Model\Report\ProductComplect\Service\Get\GetProductComplectsByParams\Data;
use App\Model\Report\ProductComplect\Service\Get\GetProductComplectsInterface;
use App\Service\Product\CreateUpdate\CreateUpdateInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductComplectController extends BaseController
{
    private GetProductComplectsInterface $getProductComplects;

    public function __construct(GetProductComplectsInterface $getProductComplects)
    {
        $this->getProductComplects = $getProductComplects;
    }

    /**
     * @SWG\Get(
     *     path="api/reports/product_complect",
     *     tags={"Products"},
     *     @SWG\Parameter(name="status", in="query", required=false, type="boolean"),
     *     @SWG\Parameter(name="saleAble", in="query", required=false, type="boolean"),
     *     @SWG\Parameter(name="name", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="price", in="query", required=false, type="number"),
     *     @SWG\Parameter(name="productTypeId", in="query", required=false, type="integer"),
     *     @SWG\Parameter(name="orderBy", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="orderDirection", in="query", required=false, type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Get all products",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/ProductsResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetProductsRequest $request
     * @return AnonymousResourceCollection
     */
    public function getProductComplectsAction(GetProductComplectsRequest $request)
    {
        return ProductComplectsResource::collection($this->getProductComplects->getProductComplects(
            new Data($request->request->get('name'), $request->request->get('sale_able'))));
    }
}
