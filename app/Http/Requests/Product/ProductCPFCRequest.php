<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class ProductCPFCRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="ProductCPFCRequest",
     *     type="object",
     *     @SWG\Property(property="calories", type="float"),
     *     @SWG\Property(property="protein", type="float"),
     *     @SWG\Property(property="fat", type="float"),
     *     @SWG\Property(property="carbs", type="float")
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'calories' => 'numeric',
            'protein' => 'numeric',
            'fat' => 'numeric',
            'carbs' => 'numeric',
        ];
    }
}
