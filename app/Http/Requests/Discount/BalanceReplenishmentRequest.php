<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class BalanceReplenishmentRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="BalanceReplenishmentRequest",
     *     type="object",
     *     @SWG\Property(property="telephone", type="string"),
     *     @SWG\Property(property="cardId", type="string"),
     *     @SWG\Property(property="bonuses", type="number"),
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'telephone' => 'required|string',
            'cardId' => 'required|string',
            'bonuses' => 'required|numeric',
            'comment' => 'nullable|string'
        ];
    }
}
