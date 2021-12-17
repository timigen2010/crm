<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class ImagePathRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="ImagePathRequest",
     *     type="object",
     *     @SWG\Property(property="path", type="string"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'path' => 'required|string'
        ];
    }
}
