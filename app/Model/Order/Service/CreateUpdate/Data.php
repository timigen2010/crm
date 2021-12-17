<?php

namespace App\Model\Order\Service\CreateUpdate;

class Data
{
    public int $companyId;
    public int $menuCompanyId;
    public int $countPerson;
    public int $countOddmoney;
    public int $countUncash;
    public ?string $discountCardId;
    public ?int $discountCardTransactionId;
    public ?int $discount;
    public ?float $countBonus;
    public ?float $countBonusAdd;
    public ?float $countVoucher;
    public ?int $userId;
    public ?int $lastEditorId;
    public ?string $deliveryMethod;
    public string $comment;
    public float $subTotal;
    public float $total;
    public int $languageId;
    public ?int $customerId;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $email;
    public ?string $telephone;
    public ?string $paymentFirstName;
    public ?string $paymentLastName;
    public ?string $address_1;
    public ?string $address_2;
    public ?string $coords;
    public ?string $city;
    public string $paymentMethod;
    public string $paymentCode;
    public ?int $courierId;
    public ?string $cookComment;
    public string $deliveryType;
    public ?string $deliveryDay;
    public ?string $deliveryTime;
    public ?array $products;
    public ?array $actions;

    public function __construct(int $companyId,
                                int $menuCompanyId,
                                int $countPerson,
                                int $countOddmoney,
                                int $countUncash,
                                ?string $discountCardId,
                                ?int $discountCardTransactionId,
                                ?int $discount,
                                ?float $countBonus,
                                ?float $countBonusAdd,
                                ?float $countVoucher,
                                ?int $userId,
                                ?int $lastEditorId,
                                ?string $deliveryMethod,
                                string $comment,
                                float $subTotal,
                                float $total,
                                int $languageId,
                                ?int $customerId,
                                ?string $firstName,
                                ?string $lastName,
                                ?string $email,
                                ?string $telephone,
                                ?string $paymentFirstName,
                                ?string $paymentLastName,
                                ?string $address_1,
                                ?string $address_2,
                                ?string $coords,
                                ?string $city,
                                string $paymentMethod,
                                string $paymentCode,
                                ?int $courierId,
                                ?string $cookComment,
                                string $deliveryType,
                                ?string $deliveryDay,
                                ?string $deliveryTime,
                                ?array $products,
                                ?array $actions)
    {
        $this->companyId = $companyId;
        $this->menuCompanyId = $menuCompanyId;
        $this->countPerson = $countPerson;
        $this->countOddmoney = $countOddmoney;
        $this->countUncash = $countUncash;
        $this->discountCardId = $discountCardId;
        $this->discountCardTransactionId = $discountCardTransactionId;
        $this->discount = $discount;
        $this->countBonus = $countBonus;
        $this->countBonusAdd = $countBonusAdd;
        $this->countVoucher = $countVoucher;
        $this->userId = $userId;
        $this->lastEditorId = $lastEditorId;
        $this->deliveryMethod = $deliveryMethod;
        $this->comment = $comment;
        $this->subTotal = $subTotal;
        $this->total = $total;
        $this->languageId = $languageId;
        $this->customerId = $customerId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->paymentFirstName = $paymentFirstName;
        $this->paymentLastName = $paymentLastName;
        $this->address_1 = $address_1;
        $this->address_2 = $address_2;
        $this->coords = $coords;
        $this->city = $city;
        $this->paymentMethod = $paymentMethod;
        $this->paymentCode = $paymentCode;
        $this->courierId = $courierId;
        $this->cookComment = $cookComment;
        $this->deliveryType = $deliveryType;
        $this->deliveryDay = $deliveryDay;
        $this->deliveryTime = $deliveryTime;
        $this->products = $products;
        $this->actions = $actions;
    }
}
