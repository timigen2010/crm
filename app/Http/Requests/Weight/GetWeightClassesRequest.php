<?php

namespace App\Http\Requests\Weight;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Swagger\Annotations as SWG;

class GetWeightClassesRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetWeightClassesRequest",
     *     type="object",
     *     @SWG\Property(property="languageId", type="integer"),
     *     @SWG\Property(property="orderBy", type="string"),
     *     @SWG\Property(property="orderDirection", type="string"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'languageId' => 'nullable|integer',
            'orderBy' => [
                'nullable',
                Rule::in([
                    'value',
                    'title',
                    'unit',
                ]),
            ],
            'orderDirection' => [
                'nullable',
                Rule::in(['desc', 'asc']),
            ],
        ];
    }
}
