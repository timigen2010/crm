<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Model\Category\Entity\Category;
use App\Model\Company\Entity\Company;
use App\Model\Customer\Entity\CustomerAddress;
use App\Model\Customer\Entity\CustomerTelephone;
use App\Model\Product\Entity\ProductConstructor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Support\Collection;

/**
 * @property int $customer_id
 * @property int $customer_group_id
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property bool $newsletter
 * @property bool $status
 * @property Collection<CustomerAddress> $customerAddresses
 * @property Collection<CustomerTelephone> $customerTelephones
 */
class CustomerResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CustomerResource",
     *     type="object",
     *     @SWG\Property(property="customerId", type="integer"),
     *     @SWG\Property(property="customerGroupId", type="integer"),
     *     @SWG\Property(property="firstName", type="string"),
     *     @SWG\Property(property="lastName", type="string"),
     *     @SWG\Property(property="email", type="string"),
     *     @SWG\Property(property="newsletter", type="boolean"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="addresses", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="customerAddressId", type="integer"),
     *              @SWG\Property(property="cityId", type="integer"),
     *              @SWG\Property(property="address_1", type="string"),
     *              @SWG\Property(property="address_2", type="string"),
     *              @SWG\Property(property="isMain", type="boolean")
     *          )
     *     ),
     *     @SWG\Property(property="telephones", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="customerTelephoneId", type="integer"),
     *              @SWG\Property(property="telephone", type="string"),
     *              @SWG\Property(property="isMain", type="boolean")
     *          )
     *     )
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'customerId' => $this->customer_id,
            'customerGroupId' => $this->customer_group_id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'newsletter' => $this->newsletter,
            'status' => $this->status,
            'addresses' => $this->customerAddresses->map(
                function (CustomerAddress $address) {
                    return [
                        'customerAddressId' => $address->customer_address_id,
                        'cityId' => $address->city_id,
                        'address_1' => $address->address_1,
                        'address_2' => $address->address_2,
                        'isMain' => $address->is_main,
                    ];
                }),
            'telephones' => $this->customerTelephones->map(
                function (CustomerTelephone $telephone) {
                    return [
                        'customerTelephoneId' => $telephone->customer_telephone_id,
                        'telephone' => $telephone->telephone,
                        'isMain' => $telephone->is_main,
                    ];
                }),
            'companies' => $this->companies->map(
                function (Company $company) {
                    return [
                        'companyId' => $company->company_id,
                        'isAdmin' => $company->is_admin,
                        'url' => $company->url,
                        'ssl' => $company->ssl,
                        'name' => $company->getDescription()->name,
                        'productConstructors' => $company->productConstructors->map(
                            function (ProductConstructor $productConstructor){
                                return [
                                    'basis' => new CategoryResource($productConstructor->basis),
                                    'mainProduct' => new ProductResource($productConstructor->mainProduct),
                                    'sauce' => new CategoryResource($productConstructor->sauce),
                                    'status' => $productConstructor->status,
                                    'deleted' => $productConstructor->deleted,
                                    'toppings' => $productConstructor->toppings->map(
                                        function (Category $topping){
                                            return [
                                                'categoryId' => $topping->category_id,
                                                'name' => $topping->getName()
                                            ];
                                        }
                                    )
                                ];
                            }
                        )
                    ];
                })
        ];
    }
}
