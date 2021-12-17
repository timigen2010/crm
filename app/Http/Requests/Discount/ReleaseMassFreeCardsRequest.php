<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class ReleaseMassFreeCardsRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="ReleaseMassFreeCardsRequest",
     *     type="object",
     *     @SWG\Property(property="start", type="integer"),
     *     @SWG\Property(property="end", type="integer"),
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'start' => 'required|integer',
            'end' => 'required|integer',
        ];
    }
}
