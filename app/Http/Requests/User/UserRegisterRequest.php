<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class UserRegisterRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="UserRegisterRequest",
     *     type="object",
     *     @SWG\Property(property="userGroupId", type="integer"),
     *     @SWG\Property(property="username", type="string"),
     *     @SWG\Property(property="password", type="string"),
     *     @SWG\Property(property="hidePhone", type="boolean"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="parentUserId", type="integer"),
     *     @SWG\Property(property="firstName", type="string"),
     *     @SWG\Property(property="lastName", type="string"),
     *     @SWG\Property(property="email", type="string"),
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'userGroupId' => 'required|integer',
            'username' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6',
            'hidePhone' => 'required|boolean',
            'status' => 'required|boolean',
            'parentUserId' => 'integer',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|unique:user_profiles|max:255',
            'sipPhone' => 'string|max:255',
            'sipPassword' => 'string|max:255',
        ];
    }
}
