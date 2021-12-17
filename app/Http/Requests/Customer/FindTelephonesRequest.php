<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class FindTelephonesRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="FindTelephonesRequest",
     *     type="object",
     *     @SWG\Property(property="telephone", type="string"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'telephone' => 'required|string',
        ];
    }
}
