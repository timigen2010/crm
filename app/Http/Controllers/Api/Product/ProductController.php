<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Requests\Product\GetProductsByCategoriesRequest;
use App\Http\Requests\Product\GetProductsRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductsResource;
use App\Model\Category\Entity\Category;
use App\Model\Product\Entity\Product;
use App\Model\Product\Service\Delete\ProductDeleteInterface;
use App\Model\Product\Service\Factory\Data as ProductFactoryData;
use App\Model\Product\Service\Get\GetByCategories\GetProductsByCategoriesInterface;
use App\Model\Product\Service\Get\GetProductsInterface;
use App\Model\Product\Service\Get\GetProductsByParams\Data as GetProductsByParamsData;
use App\Service\Product\CreateUpdate\CreateUpdateInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends BaseController
{
    private ProductDeleteInterface $productDelete;

    private GetProductsInterface $getProducts;

    private GetProductsByCategoriesInterface $getProductsByCategories;

    private CreateUpdateInterface $createUpdateService;

    public function __construct(ProductDeleteInterface $productDelete,
                                GetProductsInterface $getProducts,
                                GetProductsByCategoriesInterface $getProductsByCategories,
                                CreateUpdateInterface $createUpdateService)
    {
        $this->productDelete = $productDelete;
        $this->getProducts = $getProducts;
        $this->getProductsByCategories = $getProductsByCategories;
        $this->createUpdateService = $createUpdateService;
    }

    /**
     * @SWG\Post(
     *     path="api/products/new",
     *     tags={"Products"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ProductRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create product",
     *         @SWG\Schema(ref="#/definitions/ProductResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param ProductRequest $request
     * @return ProductResource
     */
    public function createAction(ProductRequest $request)
    {
        try {
            $product = $this->createUpdateService->handle(new ProductFactoryData(
                $request->request->get('productTypeId'),
                $request->request->get('currencyId'),
                $request->request->get('unitClassId'),
                $request->request->get('weightClassId'),
                $request->request->get('mainCategoryId'),
                $request->request->get('name'),
                $request->request->get('costPrice'),
                $request->request->get('price'),
                $request->request->get('weight'),
                $request->request->get('minimum'),
                $request->request->get('status'),
                $request->request->get('saleAble'),
                $request->request->get('cookingTime'),
                $request->request->get('dateAvailable'),
                $request->request->get('descriptions'),
                $request->request->get('menus'),
                $request->request->get('categories'),
            ));
            return new ProductResource($product);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @SWG\Put(
     *     path="api/products/edit/{product_id}",
     *     tags={"Products"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ProductRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit product by id",
     *         @SWG\Schema(ref="#/definitions/ProductResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Product $product
     * @param ProductRequest $request
     * @return ProductResource
     */
    public function editAction(Product $product, ProductRequest $request)
    {
        try {
            $product = $this->createUpdateService->handle(new ProductFactoryData(
                $request->request->get('productTypeId'),
                $request->request->get('currencyId'),
                $request->request->get('unitClassId'),
                $request->request->get('weightClassId'),
                $request->request->get('mainCategoryId'),
                $request->request->get('name'),
                $request->request->get('costPrice'),
                $request->request->get('price'),
                $request->request->get('weight'),
                $request->request->get('minimum'),
                $request->request->get('status'),
                $request->request->get('saleAble'),
                $request->request->get('cookingTime'),
                $request->request->get('dateAvailable'),
                $request->request->get('descriptions'),
                $request->request->get('menus'),
                $request->request->get('categories'),
            ), $product);
            return new ProductResource($product);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @SWG\Delete(
     *     path="api/products/delete/{product_id}",
     *     tags={"Products"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete product by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Product $product
     * @return JsonResponse
     */
    public function deleteAction(Product $product)
    {
        $this->productDelete->delete($product);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/products",
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
    public function getProductsAction(GetProductsRequest $request)
    {
        return ProductsResource::collection($this->getProducts->getProducts(new GetProductsByParamsData(
            $request->query->get('name'),
            $request->query->get('price'),
            $request->query->get('status'),
            $request->query->get('saleAble'),
            $request->query->get('productTypeId'),
            $request->query->get('orderBy'),
            $request->query->get('orderDirection'),
        )));
    }

    /**
     * @SWG\Get(
     *     path="api/products/show/{product_id}",
     *     tags={"Products"},
     *     @SWG\Response(
     *         response=200,
     *         description="Product by id",
     *         @SWG\Schema(ref="#/definitions/ProductResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Product $product
     * @return ProductResource
     */
    public function getShowAction(Product $product)
    {
        if ($product->deleted) {
            throw new NotFoundHttpException('This product was deleted');
        }
        return new ProductResource($product);
    }

    /**
     * @SWG\Post(
     *     path="api/products/by_categories",
     *     tags={"Products"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all products by categories",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/ProductsResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetProductsByCategoriesRequest $request
     * @return AnonymousResourceCollection
     */
    public function getProductsByCategoriesAction(GetProductsByCategoriesRequest $request)
    {
        return ProductsResource::collection($this->getProductsByCategories->getProducts(array_unique((array)$request['categoriesIds'])));
    }
}
