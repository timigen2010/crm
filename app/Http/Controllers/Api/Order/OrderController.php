<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Requests\Order\CreateUpdateOrderRequest;
use App\Http\Requests\Order\GetOrdersRequest;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrdersPaginationResource;
use App\Model\DB\Repository\ReceivingDBSyncRepository;
use App\Model\Order\Entity\Order;
use App\Model\Order\Repository\OrderRepository;
use App\Model\Order\Service\CreateUpdate\CreateUpdateOrderInterface;
use App\Model\Order\Service\CreateUpdate\Data as CreateUpdateOrderData;
use App\Model\Order\Service\Get\GetOrdersInterface;
use App\Model\Order\Service\Get\GetByParams\Data as GetOrdersData;
use App\Model\Order\Service\ShowInfo\ShowInfoOrderInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OrderController extends BaseController
{
    private CreateUpdateOrderInterface $createUpdateOrder;
    private GetOrdersInterface $getOrders;
    private ShowInfoOrderInterface $showInfoOrder;
    private OrderRepository $orderRepository;
    private ReceivingDBSyncRepository $dbSyncRepository;

    public function __construct(CreateUpdateOrderInterface $createUpdateOrder,
                                GetOrdersInterface $getOrders,
                                ShowInfoOrderInterface $showInfoOrder,
                                OrderRepository $orderRepository,
                                ReceivingDBSyncRepository $dbSyncRepository)
    {
        $this->createUpdateOrder = $createUpdateOrder;
        $this->getOrders = $getOrders;
        $this->showInfoOrder = $showInfoOrder;
        $this->orderRepository = $orderRepository;
        $this->dbSyncRepository = $dbSyncRepository;
    }

    /**
     * @SWG\Post(
     *     path="api/orders/new",
     *     tags={"Orders"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CreateUpdateOrderRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create order",
     *         @SWG\Schema(ref="#/definitions/OrderResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CreateUpdateOrderRequest $request
     * @return OrderResource
     */
    public function createAction(CreateUpdateOrderRequest $request)
    {
       try {
           $order = $this->createUpdateOrder->handle($this->getNewCreateUpdateOrderData($request));
           return new OrderResource($order);
       } catch (Exception $e) {
           throw new BadRequestHttpException($e->getMessage(), $e);
       }
    }

    /**
     * @SWG\Put(
     *     path="api/orders/{order_id}/edit",
     *     tags={"Orders"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CreateUpdateOrderRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit order by id",
     *         @SWG\Schema(ref="#/definitions/OrderResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Order $order
     * @param CreateUpdateOrderRequest $request
     * @return OrderResource
     */
    public function editAction(Order $order, CreateUpdateOrderRequest $request)
    {
        $order = $this->createUpdateOrder->handle($this->getNewCreateUpdateOrderData($request), $order);
        return new OrderResource($order);
    }

    /**
     * @SWG\Get(
     *     path="api/orders",
     *     tags={"Orders"},
     *     @SWG\Parameter(name="orderId", in="query", type="integer"),
     *     @SWG\Parameter(name="orderStatusId", in="query", type="integer"),
     *     @SWG\Parameter(name="userGroupId", in="query", type="integer"),
     *     @SWG\Parameter(name="customerId", in="query", type="integer"),
     *     @SWG\Parameter(name="companyId", in="query", type="integer"),
     *     @SWG\Parameter(name="updatedAt", in="query", type="string"),
     *     @SWG\Parameter(name="createdAt", in="query", type="string"),
     *     @SWG\Parameter(name="total", in="query", type="number"),
     *     @SWG\Parameter(name="page", in="query", type="integer"),
     *     @SWG\Parameter(name="limit", in="query", type="integer"),
     *     @SWG\Parameter(name="orderBy", in="query", type="string"),
     *     @SWG\Parameter(name="orderDirection", in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Get all orders",
     *         @SWG\Schema(ref="#/definitions/OrdersPaginationResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetOrdersRequest $request
     * @return OrdersPaginationResource
     */
    public function getOrdersAction(GetOrdersRequest $request)
    {
        return new OrdersPaginationResource($this->getOrders->get(new GetOrdersData(
            $request->query->get('orderId'),
            $request->query->get('orderStatusId'),
            $request->query->get('userGroupId'),
            $request->query->get('updatedAt'),
            $request->query->get('createdAt'),
            $request->query->get('customerId'),
            $request->query->get('total'),
            $request->query->get('companyId'),
            $request->query->get('orderBy'),
            $request->query->get('orderDirection'),
            $request->query->get('page'),
            $request->query->get('limit'),
        )));
    }

    /**
     * @SWG\Get(
     *     path="api/orders/{order_id}/show",
     *     tags={"Orders"},
     *     @SWG\Response(
     *         response=200,
     *         description="Order by id",
     *         @SWG\Schema(ref="#/definitions/OrderResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param int $orderId
     * @return JsonResponse
     */
    public function getShowAction(int $orderId)
    {
        try {
            return new JsonResponse($this->showInfoOrder->show($orderId));
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage(), $e);
        }
    }

    /**
     * @SWG\Post(
     *     path="api/orders/{order_id}/change_status",
     *     tags={"Orders"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CreateUpdateOrderRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Change order status",
     *         @SWG\Schema(ref="#/definitions/OrderResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Order $order
     * @param Request $request
     * @return OrderResource
     */
    public function changeStatusAction(Order $order, Request $request)
    {
//        TODO::Перенести в сервис
        $order->order_status_id = $request->get('orderStatusId');
        $order->save();
        $dfrOrder = $this->dbSyncRepository->getReverseTableRelationship('orders', $order->order_id);
        if($dfrOrder){
            $this->dispatchStatusEditingOrder($dfrOrder->foreign_table_id);
        }
        return new OrderResource($order);
    }

    private function getNewCreateUpdateOrderData(CreateUpdateOrderRequest $request)
    {
        return new CreateUpdateOrderData(
            $request->request->get('companyId'),
            $request->request->get('menuCompanyId'),
            $request->request->get('countPerson'),
            $request->request->get('countOddmoney'),
            $request->request->get('countUncash'),
            $request->request->get('discountCardId'),
            $request->request->get('discountCardTransactionId'),
            $request->request->get('discount'),
            $request->request->get('countBonus'),
            $request->request->get('countBonusAdd'),
            $request->request->get('countVoucher'),
            $request->user()->user_id,
            $request->user()->user_id,
            $request->request->get('deliveryMethod'),
            $request->request->get('comment') ?? '',
            $request->request->get('subTotal'),
            $request->request->get('total'),
            $request->request->get('languageId'),
            $request->request->get('customerId'),
            $request->request->get('firstName'),
            $request->request->get('lastName'),
            $request->request->get('email'),
            $request->request->get('telephone'),
            $request->request->get('paymentFirstName'),
            $request->request->get('paymentLastName'),
            $request->request->get('address_1'),
            $request->request->get('address_2'),
            $request->request->get('coords') ?? '',
            $request->request->get('city'),
            $request->request->get('paymentMethod'),
            $request->request->get('paymentCode'),
            $request->request->get('courierId'),
            $request->request->get('cookComment'),
            $request->request->get('deliveryType'),
            $request->request->get('deliveryDay'),
            $request->request->get('deliveryTime'),
            $request->request->get('products'),
            $request->request->get('actions')
        );
    }
}
