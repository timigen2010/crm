<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Swagger\Annotations as SWG;

class GetCategoriesRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetCategoriesRequest",
     *     type="object",
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="languageId", type="integer"),
     *     @SWG\Property(property="orderBy", type="string"),
     *     @SWG\Property(property="orderDirection", type="string"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => 'nullable|boolean',
            'name' => 'nullable|string',
            'languageId' => 'nullable|integer',
            'orderBy' => [
                'nullable',
                Rule::in([
                    'category_id'
                ]),
            ],
            'orderDirection' => [
                'nullable',
                Rule::in(['desc', 'asc']),
            ],
        ];
    }
}
