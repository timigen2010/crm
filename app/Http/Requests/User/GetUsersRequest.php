<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Swagger\Annotations as SWG;

class GetUsersRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetUsersRequest",
     *     type="object",
     *     @SWG\Property(property="username", type="string"),
     *     @SWG\Property(property="userGroupId", type="integer"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="orderBy", type="string"),
     *     @SWG\Property(property="orderDirection", type="string"),
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'userGroupId' => 'nullable|integer',
            'username' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
            'orderBy' => [
                'nullable',
                 Rule::in(['username', 'status', 'created_at', 'userGroupId']),
            ],
            'orderDirection' => [
                'nullable',
                Rule::in(['desc', 'asc']),
            ],
        ];
    }
}
