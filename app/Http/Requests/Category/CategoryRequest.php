<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class CategoryRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="CategoryRequest",
     *     type="object",
     *     @SWG\Property(property="categoryBadgeId", type="integer"),
     *     @SWG\Property(property="parentId", type="integer"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="description", type="string"),
     *              @SWG\Property(property="languageId", type="integer"),
     *              @SWG\Property(property="companyId", type="integer"),
     *              @SWG\Property(property="h1Title", type="string"),
     *              @SWG\Property(property="metaTitle", type="string"),
     *              @SWG\Property(property="shortDescription", type="string"),
     *              @SWG\Property(property="metaDescription", type="string"),
     *              @SWG\Property(property="metaKeywords", type="string")
     *          )
     *     ),
     *     @SWG\Property(property="menus", type="array",
     *          @SWG\Items(type="integer")
     *      )
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'categoryBadgeId' => 'nullable|integer',
            'parentId' => 'nullable|integer',
            'status' => 'required|boolean',
            'descriptions' => 'nullable|array',
            'descriptions.*.name' => 'required|string',
            'descriptions.*.description' => 'required|string',
            'descriptions.*.languageId' => 'required|integer',
            'descriptions.*.companyId' => 'required|integer',
            'descriptions.*.h1Title' => 'required|string',
            'descriptions.*.metaTitle' => 'required|string',
            'descriptions.*.shortDescription' => 'required|string',
            'descriptions.*.metaDescription' => 'required|string',
            'descriptions.*.metaKeywords' => 'required|string',
            'menus' => 'nullable|array',
            'menus.*' => 'required|integer',
        ];
    }
}
