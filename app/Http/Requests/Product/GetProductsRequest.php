<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Swagger\Annotations as SWG;

class GetProductsRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetProductsRequest",
     *     type="object",
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="saleAble", type="boolean"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="price", type="number"),
     *     @SWG\Property(property="productTypeId", type="integer"),
     *     @SWG\Property(property="orderBy", type="string"),
     *     @SWG\Property(property="orderDirection", type="string"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => 'nullable|boolean',
            'saleAble' => 'nullable|boolean',
            'name' => 'nullable|string',
            'price' => 'nullable|numeric',
            'productTypeId' => 'nullable|integer',
            'orderBy' => [
                'nullable',
                Rule::in([
                    'name',
                    'status',
                    'price',
                    'product_type_id',
                ]),
            ],
            'orderDirection' => [
                'nullable',
                Rule::in(['desc', 'asc']),
            ],
        ];
    }
}
