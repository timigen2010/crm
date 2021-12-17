<?php

namespace App\Http\Resources\Customer;

use App\Model\Customer\Entity\Group\CustomerGroupDescription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Support\Collection;

/**
 * @property int $customer_group_id
 * @property int $company_id
 * @property Collection<CustomerGroupDescription> $customerGroupDescriptions
 */
class CustomerGroupResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CustomerGroupResource",
     *     type="object",
     *     @SWG\Property(property="customerGroupId", type="integer"),
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="customerGroupDescriptionId", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="description", type="string"),
     *              @SWG\Property(property="languageId", type="integer")
     *          )
     *      ),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'customerGroupId' => $this->customer_group_id,
            'companyId' => $this->company_id,
            'descriptions' => $this->customerGroupDescriptions->map(
                function (CustomerGroupDescription $description) {
                    return [
                        'customerGroupDescriptionId' => $description->customer_group_description_id,
                        'description' => $description->description,
                        'name' => $description->name,
                        'languageId' => $description->language_id,
                    ];
                })
        ];
    }
}
