<?php

namespace App\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class CurrencyRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="CurrencyRequest",
     *     type="object",
     *     @SWG\Property(property="mainCurrencyId", type="integer"),
     *     @SWG\Property(property="value", type="float"),
     *     @SWG\Property(property="code", type="string"),
     *     @SWG\Property(property="decimalPlace", type="integer"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="languageId", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="symbolLeft", type="string"),
     *              @SWG\Property(property="symbolRight", type="string"),
     *          )
     *     ),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'mainCurrencyId' => 'nullable|integer',
            'value' => 'required|numeric',
            'code' => 'required|string',
            'decimalPlace' => 'required|integer',
            'status' => 'required|boolean',
            'descriptions' => 'nullable|array',
            'descriptions.*.name' => 'required|string',
            'descriptions.*.symbolLeft' => 'required|string',
            'descriptions.*.symbolRight' => 'required|string',
            'descriptions.*.languageId' => 'required|integer',
        ];
    }
}
