<?php

namespace App\Model\Customer\Service\Factory;

use App\Model\Customer\Entity\Customer;
use App\Model\Customer\Entity\CustomerTelephone;
use DomainException;
use Illuminate\Support\Facades\DB;

class CustomerFactory extends CustomerFactoryAbstract
{

    protected function setData(Data $data, Customer $customer): Customer
    {
        return DB::transaction(function () use ($customer, $data) {
            $customer->customer_group_id = $data->customerGroupId;
            $customer->firstName = $data->firstName;
            $customer->lastName = $data->lastName;
            $customer->email = $data->email;
            $customer->newsletter = $data->newsletter;
            $customer->status = $data->status;
            $customer->customerAddresses()->delete();
            $customer->save();
            foreach ($data->addresses as $address) {
                $customer->customerAddresses()->create([
                    'city_id' => $address['cityId'],
                    'customer_id' => $customer->customer_id,
                    'address_1' => $address['address_1'],
                    'address_2' => $address['address_2'],
                    'is_main' => $address['isMain'],
                ]);
            }
            foreach ($data->addTelephones as $telephone) {
                $customer->customerTelephones()->create([
                    'customer_id' => $customer->customer_id,
                    'telephone' => $telephone['telephone'],
                    'is_main' => $telephone['isMain'],
                ]);
            }
            foreach ($data->removeTelephoneIds as $id) {
                /** @var CustomerTelephone $removeTelephone */
                $removeTelephone = $customer->customerTelephones->find($id);
                if (empty($removeTelephone)) {
                    throw new DomainException("Telephone not found");
                }
                $removeTelephone->delete();
            }
            return $customer;
        });
    }
}
