<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class ActivateCardRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="ActivateCardRequest",
     *     type="object",
     *     @SWG\Property(property="customerTelephoneId", type="integer"),
     *     @SWG\Property(property="cardId", type="string"),
     *     @SWG\Property(property="code", type="integer")
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'customerTelephoneId' => 'required|integer',
            'cardId' => 'required|string',
            'code' => 'required|integer',
        ];
    }
}
