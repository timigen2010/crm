<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class ResetPasswordRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="ResetPasswordRequest",
     *     type="object",
     *     @SWG\Property(property="email", type="string"),
     *     @SWG\Property(property="redirectUrl", type="string")
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|max:255',
            'redirectUrl' => 'required|string',
        ];
    }
}
