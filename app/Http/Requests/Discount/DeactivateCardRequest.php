<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class DeactivateCardRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="DeactivateCardRequest",
     *     type="object",
     *     @SWG\Property(property="telephone", type="string"),
     *     @SWG\Property(property="cardId", type="string"),
     *     @SWG\Property(property="code", type="integer")
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'telephone' => 'required|string',
            'cardId' => 'required|string',
            'code' => 'required|integer'
        ];
    }
}
