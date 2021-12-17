<?php

namespace App\Model\Order\Service\Customer\Factory;

class Data
{
    public int $orderId;
    public ?int $customerId;
    public string $firstName;
    public ?string $lastName;
    public ?string $email;
    public ?string $telephone;

    public function __construct(int $orderId,
                                ?int $customerId,
                                string $firstName,
                                ?string $lastName,
                                ?string $email,
                                ?string $telephone)
    {
        $this->orderId = $orderId;
        $this->customerId = $customerId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->telephone = $telephone;
    }
}
