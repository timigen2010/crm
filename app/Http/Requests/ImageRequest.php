<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class ImageRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="ImageRequest",
     *     type="object",
     *     @SWG\Property(property="image", type="file"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
