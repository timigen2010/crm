<?php

namespace App\Model\Discount\Repository;

use App\Model\Discount\Entity\DiscountCard;
use Illuminate\Database\Query\JoinClause;

class DiscountCardRepository
{
    private DiscountCard $model;

    public function __construct(DiscountCard $model)
    {
        $this->model = $model;
    }

    public function findActiveCardByTelephoneId(int $customerTelephoneId)
    {
        return $this->model->query()
            ->where('customer_telephone_id', '=', $customerTelephoneId)
            ->where('active', '=', true)
            ->where('blocked', '=', false)
            ->first();
    }

//   TODO::под вопросом, может убрать
    public function findOneById(string $cardId)
    {
        $query = $this->model->query()
            ->where('discount_card_id', '=', $cardId);
        return $query->first();
    }

    public function findOneByIdAndTelephoneId(string $cardId, int $customerTelephoneId, bool $status = null)
    {
        $query = $this->model->query()
            ->where('customer_telephone_id', '=', $customerTelephoneId)
            ->where('discount_card_id', '=', $cardId);
        if (!is_null($status)) {
            $query->where('active', '=', $status);
        }
        return $query->first();
    }

    public function clearCardsByTelephoneId(string $cardId, int $customerTelephoneId)
    {
        $this->model->query()
            ->where('customer_telephone_id', '=', $customerTelephoneId)
            ->where('active', '=', false)
            ->where('discount_card_id', '!=', $cardId)
            ->delete();
    }

    public function findOneByCardIdAndCode(string $cardId, string $code, bool $status = null)
    {
        $query = $this->model->query()
            ->where('discount_card_id', '=', $cardId)
            ->where('confirm_code', '=', $code);
        if (!is_null($status)) {
            $query->where('active', '=', $status);
        }
        return $query->first();
    }

    public function findOneByCardIdAndTelephone(string $cardId, string $telephone, bool $status = null)
    {
        $query = $this->model->query()
            ->join('customer_telephones', function(JoinClause $join) {
                $join->on(
                    'customer_telephones.customer_telephone_id',
                    '=',
                    'discount_cards.customer_telephone_id')
                ;
            })
            ->where('customer_telephones.telephone', '=', $telephone)
            ->where('discount_cards.discount_card_id', '=', $cardId);
        if (!is_null($status)) {
            $query->where('discount_cards.active', '=', $status);
        }
        return $query->first();
    }

    public function findOneByCustomerIdAndTelephone(int $customerId, string $telephone, bool $status = null)
    {
        $query = $this->model->query()
            ->join('customer_telephones', function(JoinClause $join) {
                $join->on(
                    'customer_telephones.customer_telephone_id',
                    '=',
                    'discount_cards.customer_telephone_id')
                ;
            })
            ->where('customer_telephones.telephone', '=', $telephone)
            ->where('discount_cards.customer_id', '=', $customerId);
        if (!is_null($status)) {
            $query->where('discount_cards.active', '=', $status);
        }
        return $query->first();
    }

    public function checkExistsByCustomerTelephoneIds(array $ids)
    {
        if (empty($ids)) {
            return 0;
        }
        return $this->model->query()
            ->whereIn("customer_telephone_id", $ids)
            ->groupBy("customer_telephone_id")
            ->count("customer_telephone_id");
    }
}
