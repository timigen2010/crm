<?php

namespace App\Model\Order\Service\Payment\Factory;

class Data
{
    public int $orderId;
    public string $firstName;
    public ?string $lastName;
    public ?string $address_1;
    public ?string $address_2;
    public ?string $coords;
    public ?string $city;
    public string $method;
    public string $code;

    public function __construct(int $orderId,
                                string $firstName,
                                ?string $lastName,
                                ?string $address_1,
                                ?string $address_2,
                                ?string $coords,
                                ?string $city,
                                string $method,
                                string $code)
    {
        $this->orderId = $orderId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address_1 = $address_1;
        $this->address_2 = $address_2;
        $this->coords = $coords;
        $this->city = $city;
        $this->method = $method;
        $this->code = $code;
    }
}
