<?php

namespace App\Model\Order\Service\Get\GetByParams;

use App\Model\Company\Repository\CompanyRepository;
use App\Model\Order\Repository\OrderRepository;
use App\Model\Order\Repository\OrderTotalRepository;
use App\Model\Order\Service\Get\GetOrdersInterface;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;

class GetOrders implements GetOrdersInterface
{
    private OrderRepository $repository;
    private OrderTotalRepository $orderTotalRepository;
    private CompanyRepository $companyRepository;

    public function __construct(OrderRepository $repository,
                                OrderTotalRepository $orderTotalRepository,
                                CompanyRepository $companyRepository)
    {
        $this->repository = $repository;
        $this->orderTotalRepository = $orderTotalRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param Data $data
     * @return AbstractPaginator
     */
    public function get($data)
    {
        $userId = Auth::id();
        $companies = $this->companyRepository->findCompaniesByUser($userId);
        $companyIds = [];
        foreach ($companies as $company){
            $companyIds[] = $company->company_id;
        }
        $builder = $this->repository->getAllBuilder([
            "orderId" => $data->orderId,
            "orderStatusId" => $data->orderStatusId,
            "userGroupId" => $data->userGroupId,
            "updatedAt" => $data->updatedAt,
            "createdAt" => $data->createdAt,
            "customerId" => $data->customerId,
            "total" => $data->total,
            "companyId" => $data->companyId,
            "companyIds" => $companyIds
        ], [ $data->orderBy => $data->orderDirection ]);
        /** @var AbstractPaginator $pagination */
        $pagination = $builder->paginate($data->limit, ["*"], "page", $data->page);
        /** @var Collection $orderTotals */
        $orderTotals = $this->orderTotalRepository->getGroupByOrderId(
            array_map(fn(stdClass $item) => $item->order_id, $pagination->getCollection()->toArray())
        );
        $pagination->getCollection()->transform(function (stdClass $item) use ($orderTotals) {
            $orderTotal = $orderTotals->first(fn(array $totals) => $totals["order_id"] === $item->order_id);
            $totals = new Collection($orderTotal["totals"]);
            $subTotal = ($subTotal = $totals->first(fn(array $total) => $total["code"] === "sub_total"))
                ? $subTotal["value"] : 0;
            $cash = ($cash = $totals->first(fn(array $total) => $total["code"] === "cash")) ? $cash["value"] : 0;
            $discount = ($discount = $totals->first(fn(array $total) => $total["code"] === "discount"))
                ? $discount["value"] : 0;
            return new ResponseOrder(
                $item->order_id,
                $item->order_status_id,
                $item->user_id,
                $item->delivery_method,
                $item->first_name,
                $item->status_name,
                $subTotal,
                $cash,
                $discount,
                $item->total,
                $item->created_at,
                $item->updated_at
            );
        });
        return $pagination;
    }
}
