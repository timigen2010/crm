<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Requests\Customer\CustomerGroupRequest;
use App\Http\Resources\Customer\CustomerGroupResource;
use App\Model\Customer\Entity\Group\CustomerGroup;
use App\Model\Customer\Service\Group\Delete\CustomerGroupDeleteInterface;
use App\Model\Customer\Service\Group\Factory\CustomerGroupFactoryAbstract;
use App\Model\Customer\Service\Group\Factory\Data as CustomerGroupFactoryData;
use App\Model\Customer\Service\Group\Get\GetCustomerGroupsInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class CustomerGroupController extends BaseController
{
    private CustomerGroupFactoryAbstract $customerGroupFactory;

    private CustomerGroupDeleteInterface $customerGroupDelete;

    private GetCustomerGroupsInterface $getCustomerGroups;

    public function __construct(CustomerGroupFactoryAbstract $customerGroupFactory,
                                CustomerGroupDeleteInterface $customerGroupDelete,
                                GetCustomerGroupsInterface $getCustomerGroups)
    {
        $this->customerGroupFactory = $customerGroupFactory;
        $this->customerGroupDelete = $customerGroupDelete;
        $this->getCustomerGroups = $getCustomerGroups;
    }

    /**
     * @SWG\Post(
     *     path="api/customers/groups/new",
     *     tags={"Customer group"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CustomerGroupRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create customer group",
     *         @SWG\Schema(ref="#/definitions/CustomerGroupResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CustomerGroupRequest $request
     * @return CustomerGroupResource
     */
    public function createAction(CustomerGroupRequest $request)
    {
        $group = $this->customerGroupFactory->create(new CustomerGroupFactoryData(
            $request->get('companyId'),
            $request->request->get('descriptions') ?? []
        ));
        return new CustomerGroupResource($group);
    }

    /**
     * @SWG\Put(
     *     path="api/customers/groups/edit/{group_id}",
     *     tags={"Customer group"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CustomerGroupRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit group by id",
     *         @SWG\Schema(ref="#/definitions/CustomerGroupResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CustomerGroup $customerGroup
     * @param CustomerGroupRequest $request
     * @return CustomerGroupResource
     */
    public function editAction(CustomerGroup $customerGroup, CustomerGroupRequest $request)
    {
        $customerGroup = $this->customerGroupFactory->create(new CustomerGroupFactoryData(
            $request->get('companyId'),
            $request->request->get('descriptions') ?? []
        ), $customerGroup);
        return new CustomerGroupResource($customerGroup);
    }

    /**
     * @SWG\Delete(
     *     path="api/customers/groups/delete/{group_id}",
     *     tags={"Customer group"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete group by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CustomerGroup $customerGroup
     * @return JsonResponse
     */
    public function deleteAction(CustomerGroup $customerGroup)
    {
        $this->customerGroupDelete->delete($customerGroup);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/customers/groups",
     *     tags={"Customer group"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all customer groups",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/CustomerGroupResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return AnonymousResourceCollection
     */
    public function getCustomerGroupsAction()
    {
        return CustomerGroupResource::collection($this->getCustomerGroups->getGroups([]));
    }

    /**
     * @SWG\Get(
     *     path="api/customers/groups/show/{group_id}",
     *     tags={"Customer group"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show group by id",
     *         @SWG\Schema(ref="#/definitions/CustomerGroupResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CustomerGroup $customerGroup
     * @return CustomerGroupResource
     */
    public function getShowAction(CustomerGroup $customerGroup)
    {
        return new CustomerGroupResource($customerGroup);
    }
}
