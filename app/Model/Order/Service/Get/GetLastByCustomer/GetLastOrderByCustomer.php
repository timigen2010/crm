<?php

namespace App\Model\Order\Service\Get\GetLastByCustomer;

use App\Model\Company\Repository\CompanyRepository;
use App\Model\Order\Repository\OrderRepository;
use App\Model\Order\Repository\OrderTotalRepository;
use App\Model\Order\Service\Get\GetOrdersInterface;
use App\Model\Order\Service\ShowInfo\ShowInfoOrderInterface;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use stdClass;

class GetLastOrderByCustomer implements GetOrdersInterface
{
    private OrderRepository $repository;
    private ShowInfoOrderInterface $showInfoOrder;

    public function __construct(OrderRepository $repository, ShowInfoOrderInterface $showInfoOrder)
    {
        $this->repository = $repository;
        $this->showInfoOrder = $showInfoOrder;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function get($data)
    {
        $result = [];
        $order = $this->repository->findLastByCustomer($data->customerId);
        if($order){
            $result = $this->showInfoOrder->show($order->order_id);
        }
        return $result;
    }
}
