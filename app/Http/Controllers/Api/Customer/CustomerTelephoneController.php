<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Requests\Customer\FindTelephonesRequest;
use App\Http\Resources\Customer\CustomerTelephoneResource;
use App\Model\Customer\Service\Telephone\Find\FindTelephonesInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class CustomerTelephoneController extends BaseController
{
    private FindTelephonesInterface $findTelephones;

    public function __construct(FindTelephonesInterface $findTelephones)
    {
        $this->findTelephones = $findTelephones;
    }

    /**
     * @SWG\Get(
     *     path="api/customers/find_telephones",
     *     tags={"Customer telephones"},
     *     @SWG\Parameter(name="telephone", in="query", required=true, type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Get first 5 telephones by telephone",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/CustomerTelephoneResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param FindTelephonesRequest $request
     * @return AnonymousResourceCollection
     */
    public function findTelephonesAction(FindTelephonesRequest $request)
    {
        return CustomerTelephoneResource::collection($this->findTelephones->find($request->query->get('telephone')));
    }
}
