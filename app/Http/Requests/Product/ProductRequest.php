<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class ProductRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="ProductRequest",
     *     type="object",
     *     @SWG\Property(property="productTypeId", type="integer"),
     *     @SWG\Property(property="currencyId", type="integer"),
     *     @SWG\Property(property="unitClassId", type="integer"),
     *     @SWG\Property(property="weightClassId", type="integer"),
     *     @SWG\Property(property="mainCategoryId", type="integer"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="costPrice", type="number"),
     *     @SWG\Property(property="price", type="number"),
     *     @SWG\Property(property="weight", type="number"),
     *     @SWG\Property(property="minimum", type="number"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="saleAble", type="boolean"),
     *     @SWG\Property(property="cookingTime", type="integer"),
     *     @SWG\Property(property="dateAvailable", type="string"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="languageId", type="integer"),
     *              @SWG\Property(property="companyId", type="integer"),
     *              @SWG\Property(property="description", type="string"),
     *              @SWG\Property(property="seoDescription", type="string"),
     *              @SWG\Property(property="metaDescription", type="string"),
     *              @SWG\Property(property="metaTitle", type="string"),
     *              @SWG\Property(property="metaKeywords", type="string"),
     *          )
     *     ),
     *     @SWG\Property(property="images", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="image", type="string")
     *          )
     *      ),
     *    @SWG\Property(property="menus", type="array",
     *          @SWG\Items(type="integer")
     *     ),
     *    @SWG\Property(property="categories", type="array",
     *          @SWG\Items(type="integer")
     *     )
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'productTypeId' => 'required|integer',
            'currencyId' => 'required|integer',
            'unitClassId' => 'required|integer',
            'weightClassId' => 'required|integer',
            'mainCategoryId' => 'required|integer',
            'name' => 'required|string|max:255',
            'costPrice' => 'required|numeric',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'minimum' => 'required|numeric',
            'status' => 'required|boolean',
            'saleAble' => 'required|boolean',
            'cookingTime' => 'required|integer',
            'dateAvailable' => 'required|string',

            'descriptions' => 'nullable|array',
            'descriptions.*.description' => 'required|string',
            'descriptions.*.languageId' => 'required|integer',
            'descriptions.*.companyId' => 'required|integer',
            'descriptions.*.seoDescription' => 'required|string',
            'descriptions.*.metaTitle' => 'required|string',
            'descriptions.*.metaDescription' => 'required|string',
            'descriptions.*.metaKeywords' => 'required|string',

            'images' => 'nullable|array',
            'images.*.image' => 'required|string',

            'menus' => 'nullable|array',
            'menus.*' => 'required|integer',

            'categories' => 'nullable|array',
            'categories.*' => 'required|integer'
        ];
    }
}
