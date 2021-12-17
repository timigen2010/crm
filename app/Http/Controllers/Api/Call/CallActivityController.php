<?php

namespace App\Http\Controllers\Api\Call;

use App\Http\Requests\Call\CallActivityRequest;
use App\Http\Requests\Customer\GetCustomersRequest;
use App\Http\Resources\Call\CallActivitiesResource;
use App\Http\Resources\Call\CallActivityResource;;

use App\Http\Resources\Call\CheckCallResource;
use App\Model\Call\Service\CheckCall\CheckCallInterface;
use App\Model\Call\Service\Factory\CallActivityFactoryAbstract;
use App\Model\Call\Service\Get\GetCallActivitiesInterface;
use App\Model\Call\Service\Get\GetCallsByParams\Data as GetCallsByParamsData;
use App\Model\Call\Entity\CallActivity;
use App\Model\Call\Service\Factory\Data as CallActivityFactoryData;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class CallActivityController extends BaseController
{
    private CallActivityFactoryAbstract $callActivityFactory;

    private GetCallActivitiesInterface $getCallActivities;
    private CheckCallInterface $checkCall;

    public function __construct(CallActivityFactoryAbstract $callActivityFactory,
                                GetCallActivitiesInterface $getCallActivities,
                                CheckCallInterface $checkCall)
    {
        $this->callActivityFactory = $callActivityFactory;
        $this->getCallActivities = $getCallActivities;
        $this->checkCall = $checkCall;
    }

    /**
     * @SWG\Post(
     *     path="api/calls/activities/new",
     *     tags={"Call"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CallActivityRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create call activity",
     *         @SWG\Schema(ref="#/definitions/CallActivityResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CallActivityRequest $request
     * @return CallActivityResource
     */
    public function createAction(CallActivityRequest $request)
    {
        $call = $this->callActivityFactory->create(new CallActivityFactoryData(
            $request->get('sourceType'),
            $request->get('sourceId'),
            $request->get('source'),
            $request->get('destinationType'),
            $request->get('destinationId'),
            $request->get('destination'),
            $request->get('companyId'),
            $request->get('companyPhonelineId'),
            $request->get('phoneline'),
            $request->get('comment'),
            $request->get('dateStart'),
            $request->get('dateEnd'),
            $request->get('duration'),
            $request->get('durationLive'),
            $request->get('record'),
            $request->get('uniqueId'),
            $request->get('disposition'),
            $request->get('statusDial'),
        ));
        return new CallActivityResource($call);
    }

    /**
     * @SWG\Put(
     *     path="api/calls/activities/edit/{call_id}",
     *     tags={"Call"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CallActivityRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit customer by id",
     *         @SWG\Schema(ref="#/definitions/CallActivityResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CallActivity $callActivity
     * @param CallActivityRequest $request
     * @return CallActivityResource
     */
    public function editAction(CallActivity $callActivity, CallActivityRequest $request)
    {
        $call = $this->callActivityFactory->create(new CallActivityFactoryData(
            $request->get('sourceType'),
            $request->get('sourceId'),
            $request->get('source'),
            $request->get('destinationType'),
            $request->get('destinationId'),
            $request->get('destination'),
            $request->get('companyId'),
            $request->get('companyPhonelineId'),
            $request->get('phoneline'),
            $request->get('comment'),
            $request->get('dateStart'),
            $request->get('dateEnd'),
            $request->get('duration'),
            $request->get('durationLive'),
            $request->get('record'),
            $request->get('uniqueId'),
            $request->get('disposition'),
            $request->get('statusDial'),
        ), $callActivity);
        return new CallActivityResource($call);
    }

    /**
     * @SWG\Get(
     *     path="api/calls/activities",
     *     tags={"Call"},
     *     @SWG\Parameter(name="source", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="destination", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="companyId", in="query", required=false, type="integer"),
     *     @SWG\Parameter(name="statusDisposition", in="query", required=false, type="integer"),
     *     @SWG\Parameter(name="dateStart", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="dateEnd", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="orderBy", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="orderDirection", in="query", required=false, type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Get all calls",
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
    public function getCallsAction(GetCustomersRequest $request)
    {
        return CallActivitiesResource::collection($this->getCallActivities->getCalls(new GetCallsByParamsData(
            $request->query->get('source'),
            $request->query->get('destination'),
            $request->query->get('companyId'),
            $request->query->get('statusDisposition'),
            $request->query->get('dateStart'),
            $request->query->get('dateEnd'),
            $request->query->get('orderBy'),
            $request->query->get('orderDirection'),
        )));
    }

    /**
     * @SWG\Get(
     *     path="api/calls/activities/show/{call_id}",
     *     tags={"Call"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show call by id",
     *         @SWG\Schema(ref="#/definitions/CallActivityResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CallActivity $callActivity
     * @return CallActivityResource
     */
    public function getShowAction(CallActivity $callActivity)
    {
        return new CallActivityResource($callActivity);
    }

    /**
     * @SWG\Post(
     *     path="api/calls/check_call",
     *     tags={"Call"},
     *     @SWG\Response(
     *         response=200,
     *         description="Check call",
     *         @SWG\Schema(ref="#/definitions/CallActivityResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return AnonymousResourceCollection
     */
    public function checkCallAction()
    {
        return CheckCallResource::collection($this->checkCall->checkCall());
    }
}
