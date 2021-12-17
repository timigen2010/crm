<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class GetCardByCustomerRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetCardByCustomerRequest",
     *     type="object",
     *     @SWG\Property(property="telephone", type="string"),
     *     @SWG\Property(property="customerId", type="integer")
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'telephone' => 'required|string',
            'customerId' => 'required|integer'
        ];
    }
}
