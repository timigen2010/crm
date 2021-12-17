<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class GetBalanceRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetBalanceRequest",
     *     type="object",
     *     @SWG\Property(property="telephone", type="string"),
     *     @SWG\Property(property="cardId", type="string")
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'telephone' => 'required|string',
            'cardId' => 'required|string'
        ];
    }
}
