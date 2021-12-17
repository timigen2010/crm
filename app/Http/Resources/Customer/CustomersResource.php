<?php

namespace App\Http\Resources\Customer;

use App\Model\Customer\Entity\CustomerTelephone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $customer_id
 * @property int $customer_group_id
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property bool $newsletter
 * @property bool $status
 * @property Collection<CustomerTelephone> $customerTelephones
 */
class CustomersResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CustomersResource",
     *     type="object",
     *     @SWG\Property(property="customerId", type="integer"),
     *     @SWG\Property(property="firstName", type="string"),
     *     @SWG\Property(property="lastName", type="string"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="telephone", type="string"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $mainTelephone = $this->customerTelephones->firstWhere('is_main', true);
        return [
            'customerId' => $this->customer_id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'status' => $this->status,
            'telephone' => $mainTelephone ? $mainTelephone->telephone : ''
        ];
    }
}
