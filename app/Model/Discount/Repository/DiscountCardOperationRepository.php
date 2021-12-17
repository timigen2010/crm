<?php

namespace App\Model\Discount\Repository;

use App\Model\Discount\Entity\DiscountCardOperation;
use Illuminate\Database\Eloquent\Builder;

class DiscountCardOperationRepository
{
    private DiscountCardOperation $model;

    public function __construct(DiscountCardOperation $model)
    {
        $this->model = $model;
    }

    public function getAllBuilder(string $type = null): Builder
    {
        $query = $this->model->query();
        if ($type) {
            $query->where('type', $type);
        }
        return $query->orderBy('discount_card_operation_id', 'desc');
    }
}
