<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class CategoryBadgeRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="CategoryBadgeRequest",
     *     type="object",
     *     @SWG\Property(property="code", type="string"),
     *     @SWG\Property(property="image", type="string")
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string',
            'image' => 'nullable|string',
        ];
    }
}
