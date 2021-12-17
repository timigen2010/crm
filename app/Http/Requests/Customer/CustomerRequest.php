<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class CustomerRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="CustomerRequest",
     *     type="object",
     *     @SWG\Property(property="customerGroupId", type="integer"),
     *     @SWG\Property(property="firstName", type="string"),
     *     @SWG\Property(property="lastName", type="string"),
     *     @SWG\Property(property="email", type="string"),
     *     @SWG\Property(property="newsletter", type="boolean"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="addresses", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="cityId", type="integer"),
     *              @SWG\Property(property="address_1", type="string"),
     *              @SWG\Property(property="address_2", type="string"),
     *              @SWG\Property(property="isMain", type="boolean")
     *          )
     *     ),
     *     @SWG\Property(property="addTelephones", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="telephone", type="string"),
     *              @SWG\Property(property="isMain", type="boolean")
     *          )
     *     ),
     *     @SWG\Property(property="removeTelephoneIds", type="array",
     *          @SWG\Items(type="integer")
     *     )
     *  )
     * @return array
     */
    public function rules(): array
    {
        if (!empty($this->route()->parameters['customer'])) {
            $validateEmail = 'nullable|string|max:255|unique:customers,email,'
                . $this->route()->parameters['customer']->customer_id . ',customer_id';
        } else {
            $validateEmail = 'nullable|string|max:255|unique:customers';
        }
        return [
            'customerGroupId' => 'required|integer',
            'firstName' => 'required|string',
            'lastName' => 'nullable|string',
            'email' => $validateEmail,
            'addresses' => 'nullable|array',
            'addresses.*.cityId' => 'required|integer',
            'addresses.*.address_1' => 'required|string',
            'addresses.*.address_2' => 'nullable|string',
            'addresses.*.isMain' => 'required|boolean',
            'addTelephones' => 'nullable|array',
            'addTelephones.*.telephone' => 'required|string',
            'addTelephones.*.isMain' => 'required|boolean',
            'removeTelephoneIds' => 'nullable|array',
            'removeTelephoneIds.*' => 'required|integer',
        ];
    }
}
