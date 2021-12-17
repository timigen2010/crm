<?php

namespace App\Model\Discount\Service\CardOperation\GetOperations;

use App\Model\Discount\Repository\DiscountCardOperationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetHistoryOperations implements GetOperationsInterface
{
    private DiscountCardOperationRepository $repository;

    public function __construct(DiscountCardOperationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Data $data
     * @return LengthAwarePaginator
     */
    public function getOperations($data)
    {
        $builder = $this->repository->getAllBuilder($data->type);
        return $builder->paginate($data->limit, ["*"], "page", $data->page);
    }
}
