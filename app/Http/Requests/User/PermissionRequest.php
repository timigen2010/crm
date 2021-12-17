<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class PermissionRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="PermissionRequest",
     *     type="object",
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="description", type="string"),
     *              @SWG\Property(property="languageId", type="integer")
     *          )
     *     )
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'descriptions' => 'nullable|array',
            'descriptions.*.description' => 'required|string',
            'descriptions.*.languageId' => 'required|integer',
        ];
    }
}
