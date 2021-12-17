<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Swagger\Annotations as SWG;

class GetCustomersRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetCustomersRequest",
     *     type="object",
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="groupId", type="integer"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="telephone", type="string"),
     *     @SWG\Property(property="orderBy", type="string"),
     *     @SWG\Property(property="orderDirection", type="string"),
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'groupId' => 'nullable|integer',
            'name' => 'nullable|string|max:255',
            'telephone' => 'nullable|string',
            'status' => 'nullable|boolean',
            'orderBy' => [
                'nullable',
                Rule::in(['customer_id', 'status', 'telephone', 'name']),
            ],
            'orderDirection' => [
                'nullable',
                Rule::in(['desc', 'asc']),
            ],
        ];
    }
}
