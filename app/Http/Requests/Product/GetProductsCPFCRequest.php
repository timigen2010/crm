<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class GetProductsCPFCRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetProductsCPFCRequest",
     *     type="object",
     *     @SWG\Property(property="productIds", type="array")
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'productIds' => 'nullable|array'
        ];
    }
}
