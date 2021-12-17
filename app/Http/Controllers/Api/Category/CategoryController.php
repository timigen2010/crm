<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\GetCategoriesRequest;
use App\Http\Resources\Category\CategoriesResource;
use App\Http\Resources\Category\CategoryResource;
use App\Model\Category\Entity\Category;
use App\Model\Category\Service\Delete\CategoryDeleteInterface;
use App\Model\Category\Service\Factory\CategoryFactoryAbstract;
use App\Model\Category\Service\Factory\Data as CategoryFactoryData;
use App\Model\Category\Service\Get\GetCategoriesInterface;
use App\Model\Category\Service\Get\GetCategoriesByParams\Data as GetCategoriesByParamsData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class CategoryController extends BaseController
{
    private CategoryFactoryAbstract $categoryFactory;

    private CategoryDeleteInterface $categoryDelete;

    private GetCategoriesInterface $getCategories;

    public function __construct(CategoryFactoryAbstract $categoryFactory,
                                CategoryDeleteInterface $categoryDelete,
                                GetCategoriesInterface $getCategories)
    {
        $this->categoryFactory = $categoryFactory;
        $this->categoryDelete = $categoryDelete;
        $this->getCategories = $getCategories;
    }

    /**
     * @SWG\Post(
     *     path="api/categories/new",
     *     tags={"Categories"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CategoryRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create category",
     *         @SWG\Schema(ref="#/definitions/CategoryResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function createAction(CategoryRequest $request)
    {
        $category = $this->categoryFactory->create(new CategoryFactoryData(
            $request->request->get('descriptions') ?? [],
            $request->request->get('categoryBadgeId'),
            $request->request->get('status'),
            $request->request->get('menus') ?? [],
            $request->request->get('parentId')
        ));
        return new CategoryResource($category);
    }

    /**
     * @SWG\Put(
     *     path="api/categories/edit/{category_id}",
     *     tags={"Categories"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CategoryRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit category by id",
     *         @SWG\Schema(ref="#/definitions/CategoryResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Category $category
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function editAction(Category $category, CategoryRequest $request)
    {
        $category = $this->categoryFactory->create(new CategoryFactoryData(
            $request->request->get('descriptions') ?? [],
            $request->request->get('categoryBadgeId'),
            $request->request->get('status'),
            $request->request->get('menus') ?? [],
            $request->request->get('parentId')
        ), $category);
        return new CategoryResource($category);
    }

    /**
     * @SWG\Delete(
     *     path="api/categories/delete/{category_id}",
     *     tags={"Categories"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete category by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Category $category
     * @return JsonResponse
     */
    public function deleteAction(Category $category)
    {
        $this->categoryDelete->delete($category);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/categories",
     *     tags={"Categories"},
     *     @SWG\Parameter(name="status", in="query", required=false, type="boolean"),
     *     @SWG\Parameter(name="name", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="languageId", in="query", required=false, type="integer"),
     *     @SWG\Parameter(name="orderBy", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="orderDirection", in="query", required=false, type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Get all categories",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/CategoriesResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetCategoriesRequest $request
     * @return AnonymousResourceCollection
     */
    public function getCategoriesAction(GetCategoriesRequest $request)
    {
        return CategoriesResource::collection($this->getCategories->getCategories(new GetCategoriesByParamsData(
            $request->query->get('status'),
            $request->query->get('name'),
            $request->query->get('languageId'),
            $request->query->get('orderBy'),
            $request->query->get('orderDirection')
        )));
    }

    /**
     * @SWG\Get(
     *     path="api/categories/show/{category_id}",
     *     tags={"Categories"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show category by id",
     *         @SWG\Schema(ref="#/definitions/CategoryResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Category $category
     * @return CategoryResource
     */
    public function getShowAction(Category $category)
    {
        return new CategoryResource($category);
    }
}
