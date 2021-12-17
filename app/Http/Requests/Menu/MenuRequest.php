<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class MenuRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="MenuRequest",
     *     type="object",
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="companies", type="array",
     *          @SWG\Items(type="integer")
     *      )
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'companies' => 'nullable|array',
            'companies.*' => 'required|integer'
        ];
    }
}
