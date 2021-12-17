<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $customer_telephone_id
 * @property int $customer_id
 * @property string $telephone
 * @property bool $is_main
 */
class CustomerTelephoneResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CustomerTelephoneResource",
     *     type="object",
     *     @SWG\Property(property="customerTelephoneId", type="integer"),
     *     @SWG\Property(property="customerId", type="integer"),
     *     @SWG\Property(property="telephone", type="string"),
     *     @SWG\Property(property="isMain", type="boolean"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'customerTelephoneId' => $this->customer_telephone_id,
            'customerId' => $this->customer_id,
            'telephone' => $this->telephone,
            'isMain' => $this->is_main,
        ];
    }
}
