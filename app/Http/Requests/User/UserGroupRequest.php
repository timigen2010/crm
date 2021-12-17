<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class UserGroupRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="UserGroupRequest",
     *     type="object",
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="permissions", type="array",
     *          @SWG\Items(type="integer")
     *     )
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'permissions' => 'nullable|array',
            'permissions.*' => 'required|integer',
        ];
    }
}
