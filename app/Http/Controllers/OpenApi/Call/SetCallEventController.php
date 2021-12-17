<?php

namespace App\Http\Controllers\OpenApi\Call;

use App\Http\Requests\Call\SetCallEventRequest;
use App\Model\Call\Service\SetCallEvent\SetCallEvent;
use App\Model\Call\Service\SetCallEvent\SetCallEventInterface;
use App\Model\Call\Service\SetCallEvent\SetEvent\Data as SetEventData;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

class SetCallEventController extends BaseController
{
    private SetCallEventInterface $setCallEvent;

    public function __construct(SetCallEventInterface $setCallEvent)
    {
        $this->setCallEvent = $setCallEvent;
    }

    /**
     * @SWG\Post(
     *     path="api/calls/set_event",
     *     tags={"Call"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SetCallEventRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Set call event",
     *         @SWG\Schema(type="boolean")
     *      )
     * )
     * @param SetCallEventRequest $request
     * @return JsonResponse
     */
    public function setCallEventAction(SetCallEventRequest $request)
    {
        Log::info(json_encode($request));
        try {
            $json = $this->setCallEvent->setCallEvent(new SetEventData(
                $request->request->get('event'),
                $request->request->get('uniqueid'),
                $request->request->get('source'),
                $request->request->get('destination'),
                $request->request->get('calleridname'),
                $request->request->get('calleridnum'),
                $request->request->get('connectedlinenum'),
                $request->request->get('callerid1'),
                $request->request->get('callerid2'),
                $request->request->get('subevent'),
                $request->request->get('confirm'),
                $request->request->get('starttime'),
                $request->request->get('endtime'),
                $request->request->get('duration'),
                $request->request->get('billableseconds'),
                $request->request->get('recordingfile'),
                $request->request->get('disposition'),
            ));
            return new JsonResponse($json);
        } catch (\DomainException $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
