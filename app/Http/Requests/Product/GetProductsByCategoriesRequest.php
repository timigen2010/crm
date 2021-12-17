<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Swagger\Annotations as SWG;

class GetProductsByCategoriesRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetProductsByCategoriesRequest",
     *     type="object",
     *     @SWG\Property(property="status", type="array"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'categoriesIds' => 'nullable|array'
        ];
    }
}
