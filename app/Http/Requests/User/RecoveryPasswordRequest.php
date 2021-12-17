<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class RecoveryPasswordRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="RecoveryPasswordRequest",
     *     type="object",
     *     @SWG\Property(property="confirmToken", type="string"),
     *     @SWG\Property(property="password", type="string")
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'confirmToken' => 'required|string',
            'password' => 'required|string|min:6',
        ];
    }
}
