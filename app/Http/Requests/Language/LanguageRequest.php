<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class LanguageRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="LanguageRequest",
     *     type="object",
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="code", type="string"),
     *     @SWG\Property(property="locale", type="string"),
     *     @SWG\Property(property="image", type="string"),
     *     @SWG\Property(property="status", type="boolean"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'locale' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ];
    }
}
