<?php

namespace App\Model\Customer\Service\Factory;

class Data
{
    public int $customerGroupId;
    public string $firstName;
    public string $lastName;
    public ?string $email;
    public bool $newsletter;
    public bool $status;
    public array $addresses;
    public array $addTelephones;
    public array $removeTelephoneIds;

    public function __construct(int $customerGroupId,
                                string $firstName,
                                string $lastName,
                                ?string $email,
                                bool $newsletter,
                                bool $status,
                                array $addresses,
                                array $addTelephones,
                                array $removeTelephoneIds)
    {
        $this->customerGroupId = $customerGroupId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->newsletter = $newsletter;
        $this->status = $status;
        $this->addresses = $addresses;
        $this->addTelephones = $addTelephones;
        $this->removeTelephoneIds = $removeTelephoneIds;
    }
}
