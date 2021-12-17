<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Common\GetDirectoriesRequest;
use App\Http\Resources\Common\DirectoriesResource;
use App\Service\Directory\GetDirectories\GetDirectoriesInterface;
use App\Service\Directory\GetDirectories\Data as GetDirectoriesData;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class DirectoryController extends BaseController
{
    private GetDirectoriesInterface $getDirectories;

    public function __construct(GetDirectoriesInterface $getDirectories)
    {
        $this->getDirectories = $getDirectories;
    }

    /**
     * @SWG\Get(
     *     path="api/directories",
     *     tags={"Common API"},
     *     @SWG\Parameter(name="isLanguages", in="query", type="boolean"),
     *     @SWG\Parameter(name="isCategoryBadges", in="query", type="boolean"),
     *     @SWG\Parameter(name="isCategories", in="query", type="boolean"),
     *     @SWG\Parameter(name="isCompanies", in="query", type="boolean"),
     *     @SWG\Parameter(name="isMenus", in="query", type="boolean"),
     *     @SWG\Parameter(name="isCurrencies", in="query", type="boolean"),
     *     @SWG\Parameter(name="isUnitClasses", in="query", type="boolean"),
     *     @SWG\Parameter(name="isWeightClasses", in="query", type="boolean"),
     *     @SWG\Parameter(name="isProductTypes", in="query", type="boolean"),
     *     @SWG\Response(
     *         response=200,
     *         description="Get directories",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/DirectoriesResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetDirectoriesRequest $request
     * @return DirectoriesResource
     */
    public function getDirectoriesAction(GetDirectoriesRequest $request)
    {
        return new DirectoriesResource($this->getDirectories->get(new GetDirectoriesData(
            $request->query->get('isLanguages') ?? false,
            $request->query->get('isCategoryBadges') ?? false,
            $request->query->get('isCategories') ?? false,
            $request->query->get('isCompanies') ?? false,
            $request->query->get('isMenus') ?? false,
            $request->query->get('isCurrencies') ?? false,
            $request->query->get('isUnitClasses') ?? false,
            $request->query->get('isWeightClasses') ?? false,
            $request->query->get('isProductTypes') ?? false,
        )));
    }

}
