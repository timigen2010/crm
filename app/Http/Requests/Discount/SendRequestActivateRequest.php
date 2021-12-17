<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class SendRequestActivateRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="SendRequestActivateRequest",
     *     type="object",
     *     @SWG\Property(property="cardId", type="string"),
     *     @SWG\Property(property="telephone", type="string"),
     *     @SWG\Property(property="isSendCode", type="boolean"),
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'cardId' => 'required|string',
            'telephone' => 'required|string',
            'isSendCode' => 'required|boolean',
        ];
    }
}
