<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class GetSettingByKeyRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetSettingByKeyRequest",
     *     type="object",
     *     @SWG\Property(property="key", type="string"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string|max:255',
        ];
    }
}
