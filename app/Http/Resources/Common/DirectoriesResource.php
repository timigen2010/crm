<?php

namespace App\Http\Resources\Common;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

class DirectoriesResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="DirectoriesResource",
     *     type="object",
     *     @SWG\Property(property="languages", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="languageId", type="integer"),
     *          @SWG\Property(property="code", type="string"),
     *     )),
     *     @SWG\Property(property="categoryBadges", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="categoryBadgeId", type="integer"),
     *          @SWG\Property(property="code", type="string"),
     *     )),
     *     @SWG\Property(property="categories", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="categoryId", type="integer"),
     *          @SWG\Property(property="name", type="string"),
     *     )),
     *     @SWG\Property(property="companies", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="companyId", type="integer"),
     *          @SWG\Property(property="name", type="string"),
     *     )),
     *     @SWG\Property(property="menus", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="menuId", type="integer"),
     *          @SWG\Property(property="name", type="string"),
     *     )),
     *     @SWG\Property(property="currencies", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="currencyId", type="integer"),
     *          @SWG\Property(property="name", type="string"),
     *     )),
     *     @SWG\Property(property="unitClasses", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="unitClassId", type="integer"),
     *          @SWG\Property(property="unit", type="string"),
     *     )),
     *     @SWG\Property(property="weightClasses", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="weightClassId", type="integer"),
     *          @SWG\Property(property="unit", type="string"),
     *     )),
     *     @SWG\Property(property="productTypes", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="productTypeId", type="integer"),
     *          @SWG\Property(property="typeCode", type="string"),
     *     )),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->resource;
    }
}
