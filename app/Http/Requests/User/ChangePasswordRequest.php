<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class ChangePasswordRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="ChangePasswordRequest",
     *     type="object",
     *     @SWG\Property(property="oldPassword", type="string"),
     *     @SWG\Property(property="newPassword", type="string")
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'oldPassword' => 'required|string|max:255',
            'newPassword' => 'required|string|max:255|min:6',
        ];
    }
}
