<?php

namespace App\Model\Order\Service\ShowInfo;

use App\Model\Order\Entity\Order;
use App\Model\Order\Entity\OrderOption;
use App\Model\Order\Entity\OrderProduct;
use App\Model\Order\Repository\OrderOptionRepository;
use App\Model\Order\Repository\OrderRepository;
use DomainException;
use Illuminate\Support\Facades\Log;

class ShowTotalInfoOrder implements ShowInfoOrderInterface
{
    private OrderRepository $repository;
    private OrderOptionRepository $optionRepository;
    private array $orderOptionsByProduct;

    public function __construct(OrderRepository $repository, OrderOptionRepository $optionRepository)
    {
        $this->repository = $repository;
        $this->optionRepository = $optionRepository;
    }

    public function show(int $orderId): array
    {
        /** @var Order $order */
        $order = $this->repository->findOneById($orderId);
        $orderOptions = $this->optionRepository->getByOrderId($orderId);
        $this->formOrderOptionsByProduct($orderOptions);
        if($order->delivery_method == 'delivery'){
            if(!empty($order->orderCourier)){
                $deliveryMethod = ''.$order->orderCourier->courier_id;
            }
            else{
                $deliveryMethod = '';
            }
        }
        else{
            $deliveryMethod = $order->delivery_method;
        }

        $orderProducts = $order->orderProducts->filter(function (OrderProduct $orderProduct){
            return !$orderProduct->deleted;
        })->values()->map(function (OrderProduct $orderProduct) {
//          TODO:://перенести в репозиторий или сервис
            $options = $this->getOrderOptionsForProduct($orderProduct->product_id);
            return [
                'productId' => (int)$orderProduct->product_id,
                'name' => $orderProduct->name,
                'price' => $orderProduct->price,
                'amount' => (float)$orderProduct->amount,
                'options' => $options,
            ];
        });

        if (!empty($order)) {
            return [
                "orderId" => $order->order_id,
                "companyId" => $order->company->company_id,
                "companyName" => $order->company->getName($order->language_id),
                "menuId" => $order->menu->menu_id,
                "menuCompanyName" => $order->menu->name,
                "customerId" => $order->orderCustomer->customer_id,
                "customer" => $order->orderCustomer->getFullName(),
                "telephone" => $order->orderCustomer->telephone,
                "email" => $order->orderCustomer->email,
                "countPerson" => $order->count_person,
                "countUncash" => $order->count_uncash,
                "countOddMoney" => $order->count_oddmoney,
                "comment" => $order->comment,
                "discountCard" => $order->discount_card_id,
                "countBonus" => $order->count_bonus,
                "deliveryMethod" => $deliveryMethod,
                "deliveryTime" => $order->orderDeliveryTimes->first(),
                "paymentCode"=> $order->orderPayment->code,
                "productCart" => $orderProducts,
                "createdAt" => $order->created_at,
                "updatedAt" => $order->updated_at,
            ];
        }
        throw new DomainException("Order not found");
    }

    private function formOrderOptionsByProduct($orderOptions){
        $orderOptionsByProduct = [];
        foreach ($orderOptions as $orderOption){
            if(empty($orderOptionsByProduct[$orderOption->product_main_id])){
                $orderOptionsByProduct[$orderOption->product_main_id] = [];
            }
            $orderOptionsByProduct[$orderOption->product_main_id][] = $orderOption;
        }
        $this->orderOptionsByProduct = $orderOptionsByProduct;
    }

    private function getOrderOptionsForProduct(int $productId){
        $options = [];

        if(!empty($this->orderOptionsByProduct[$productId])){
            $segmentId = $this->orderOptionsByProduct[$productId][0]->product_main_key;
            foreach ($this->orderOptionsByProduct[$productId] as $index=>$option){
                if($option->product_main_key == $segmentId){
                    $options[] = [
                        "productMainId" => (int)$option->product_main_id,
                        "productId" => (int)$option->product_id,
                        "amount" => (float)$option->amount
                    ];
                    array_splice($this->orderOptionsByProduct[$productId], $index, 1);
                }
                else{
                    break;
                }
            }
        }

        return $options;
    }
}
