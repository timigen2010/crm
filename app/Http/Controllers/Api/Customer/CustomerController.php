<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Requests\Customer\CustomerRequest;
use App\Http\Requests\Customer\GetCustomersRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Customer\CustomersResource;
use App\Http\Resources\Order\OrderResource;
use App\Model\Customer\Entity\Customer;
use App\Model\Customer\Service\Factory\Data as CustomerFactoryData;
use App\Model\Customer\Service\Get\GetCustomersInterface;
use App\Model\Customer\Service\Get\GetCustomersByParams\Data as GetCustomersData;
use App\Model\DB\Repository\ReceivingDBSyncRepository;
use App\Model\Order\Repository\OrderRepository;
use App\Model\Order\Service\Get\GetLastByCustomer\Data as GetLastByCustomerData;
use App\Model\Order\Service\Get\GetLastByCustomer\GetLastOrderByCustomer;
use App\Model\Order\Service\Get\GetOrdersInterface;
use App\Service\Customer\CreateUpdate\CreateUpdateCustomerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Swagger\Annotations as SWG;

class CustomerController extends BaseController
{
    private CreateUpdateCustomerInterface $createUpdateCustomer;
    private GetCustomersInterface $getCustomers;
    private ReceivingDBSyncRepository $syncRepository;
    private OrderRepository $orderRepository;
    private GetOrdersInterface $getLastOrderByCustomer;

    public function __construct(CreateUpdateCustomerInterface $createUpdateCustomer,
                                GetCustomersInterface $getCustomers,
                                ReceivingDBSyncRepository $syncRepository,
                                OrderRepository $orderRepository,
                                GetLastOrderByCustomer $getLastOrderByCustomer)
    {
        $this->createUpdateCustomer = $createUpdateCustomer;
        $this->getCustomers = $getCustomers;
        $this->syncRepository = $syncRepository;
        $this->orderRepository = $orderRepository;
        $this->getLastOrderByCustomer = $getLastOrderByCustomer;
    }

    /**
     * @SWG\Post(
     *     path="api/customers/new",
     *     tags={"Customer"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CustomerRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create customer",
     *         @SWG\Schema(ref="#/definitions/CustomerResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CustomerRequest $request
     * @return CustomerResource
     */
    public function createAction(CustomerRequest $request)
    {
        $group = $this->createUpdateCustomer->handle(new CustomerFactoryData(
            $request->get('customerGroupId'),
            $request->get('firstName'),
            $request->get('lastName'),
            $request->get('email'),
            $request->get('newsletter'),
            $request->get('status'),
            $request->get('addresses') ?? [],
            $request->get('addTelephones') ?? [],
            $request->get('removeTelephoneIds') ?? [],
        ));
        return new CustomerResource($group);
    }

    /**
     * @SWG\Put(
     *     path="api/customers/edit/{customer_id}",
     *     tags={"Customer"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CustomerRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit customer by id",
     *         @SWG\Schema(ref="#/definitions/CustomerResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Customer $customer
     * @param CustomerRequest $request
     * @return CustomerResource
     */
    public function editAction(Customer $customer, CustomerRequest $request)
    {
        $group = $this->createUpdateCustomer->handle(new CustomerFactoryData(
            $request->get('customerGroupId'),
            $request->get('firstName'),
            $request->get('lastName') ?? '',
            $request->get('email'),
            $request->get('newsletter'),
            $request->get('status'),
            $request->get('addresses') ?? [],
            $request->get('addTelephones') ?? [],
            $request->get('removeTelephoneIds') ?? [],
        ), $customer);

        return new CustomerResource($group);
    }

    /**
     * @SWG\Get(
     *     path="api/customers",
     *     tags={"Customer"},
     *     @SWG\Parameter(name="groupId", in="query", required=false, type="integer"),
     *     @SWG\Parameter(name="name", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="telephone", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="status", in="query", required=false, type="boolean"),
     *     @SWG\Parameter(name="orderBy", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="orderDirection", in="query", required=false, type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Get all customers",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/CustomersResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetCustomersRequest $request
     * @return AnonymousResourceCollection
     */
    public function getCustomersAction(GetCustomersRequest $request)
    {
        return CustomersResource::collection($this->getCustomers->getCustomers(new GetCustomersData(
            $request->query->get('name'),
            $request->query->get('groupId'),
            $request->query->get('status'),
            $request->query->get('telephone'),
            $request->query->get('orderBy'),
            $request->query->get('orderDirection'),
        )));
    }

    /**
     * @SWG\Get(
     *     path="api/customers/show/{customer_id}",
     *     tags={"Customer"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show customer by id",
     *         @SWG\Schema(ref="#/definitions/CustomerResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Customer $customer
     * @return CustomerResource
     */
    public function getShowAction(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * @SWG\Get(
     *     path="api/customers/last_order/{customer_id}",
     *     tags={"Customer"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show customers last order by id",
     *         @SWG\Schema(ref="#/definitions/CustomerResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Customer $customer
     * @return JsonResponse
     */
    public function getLastOrderAction(Customer $customer)
    {
        return new JsonResponse($this->getLastOrderByCustomer->get(new GetLastByCustomerData($customer->customer_id)));
    }
}
