<?php

namespace App\Http\Requests\Weight;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class WeightClassRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="WeightClassRequest",
     *     type="object",
     *     @SWG\Property(property="mainClassId", type="integer"),
     *     @SWG\Property(property="value", type="float"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="languageId", type="integer"),
     *              @SWG\Property(property="title", type="string"),
     *              @SWG\Property(property="unit", type="string"),
     *          )
     *     ),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'mainClassId' => 'nullable|integer',
            'value' => 'required|numeric',
            'descriptions' => 'nullable|array',
            'descriptions.*.title' => 'required|string',
            'descriptions.*.unit' => 'required|string',
            'descriptions.*.languageId' => 'required|integer',
        ];
    }
}
