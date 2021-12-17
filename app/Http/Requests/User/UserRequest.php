<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class UserRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="UserRequest",
     *     type="object",
     *     @SWG\Property(property="userGroupId", type="integer"),
     *     @SWG\Property(property="username", type="string"),
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
        if ($this->route()->parameters['user']) {
            $validateEmail = 'required|string|max:255|unique:user_profiles,email,'
                . $this->route()->parameters['user']->user_id . ',user_id';
            $validateUsername = 'required|string|max:255|unique:users,username,'
                . $this->route()->parameters['user']->user_id . ',user_id';
        } else {
            $validateEmail = 'required|string|max:255|unique:user_profiles';
            $validateUsername = 'required|string|max:255|unique:users';
        }
        return [
            'userGroupId' => 'required|integer',
            'username' => $validateUsername,
            'hidePhone' => 'required|boolean',
            'status' => 'required|boolean',
            'parentUserId' => 'integer',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => $validateEmail,
        ];
    }
}
