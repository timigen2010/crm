<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class CustomerGroupRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="CustomerGroupRequest",
     *     type="object",
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="name", type="string"),
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
            'companyId' => 'required|integer',
            'descriptions' => 'nullable|array',
            'descriptions.*.name' => 'required|string',
            'descriptions.*.description' => 'required|string',
            'descriptions.*.languageId' => 'required|integer',
        ];
    }
}
