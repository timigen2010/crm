<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class CategoryImageRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="CategoryImageRequest",
     *     type="object",
     *     @SWG\Property(property="image", type="file"),
     *     @SWG\Property(property="imageType", type="integer"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'imageType' => 'required|integer'
        ];
    }
}
