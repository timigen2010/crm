<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class UserAvatarRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="UserAvatarRequest",
     *     type="object",
     *     @SWG\Property(property="avatar", type="file"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
