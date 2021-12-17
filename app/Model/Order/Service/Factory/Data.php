<?php

namespace App\Model\Order\Service\Factory;

class Data
{
    public int $companyId;
    public int $menuCompanyId;
    public int $countPerson;
    public int $countOddmoney;
    public int $countUncash;
    public ?string $discountCardId;
    public ?int $discountCardTransactionId;
    public ?float $countBonus;
    public ?float $countBonusAdd;
    public ?float $countVoucher;
    public ?int $userId;
    public ?int $lastEditorId;
    public ?string $deliveryMethod;
    public string $comment;
    public float $total;
    public int $orderStatusId;
    public int $languageId;
    public int $currencyId;
    public string $currencyCode;
    public float $currencyValue;

    public function __construct(int $companyId,
                                int $menuCompanyId,
                                int $countPerson,
                                int $countOddmoney,
                                int $countUncash,
                                ?string $discountCardId,
                                ?int $discountCardTransactionId,
                                ?float $countBonus,
                                ?float $countBonusAdd,
                                ?float $countVoucher,
                                ?int $userId,
                                ?int $lastEditorId,
                                ?string $deliveryMethod,
                                string $comment,
                                float $total,
                                int $orderStatusId,
                                int $languageId,
                                int $currencyId,
                                string $currencyCode,
                                float $currencyValue)
    {
        $this->companyId = $companyId;
        $this->menuCompanyId = $menuCompanyId;
        $this->countPerson = $countPerson;
        $this->countOddmoney = $countOddmoney;
        $this->countUncash = $countUncash;
        $this->discountCardId = $discountCardId;
        $this->discountCardTransactionId = $discountCardTransactionId;
        $this->countBonus = $countBonus;
        $this->countBonusAdd = $countBonusAdd;
        $this->countVoucher = $countVoucher;
        $this->userId = $userId;
        $this->lastEditorId = $lastEditorId;
        $this->deliveryMethod = $deliveryMethod;
        $this->comment = $comment;
        $this->total = $total;
        $this->orderStatusId = $orderStatusId;
        $this->languageId = $languageId;
        $this->currencyId = $currencyId;
        $this->currencyCode = $currencyCode;
        $this->currencyValue = $currencyValue;
    }
}
