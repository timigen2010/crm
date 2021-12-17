<?php

namespace App\Http\Controllers\Api\Discount;

use App\Http\Requests\Discount\ActivateCardRequest;
use App\Http\Requests\Discount\BalanceReplenishmentRequest;
use App\Http\Requests\Discount\DeactivateCardRequest;
use App\Http\Requests\Discount\GetBalanceRequest;
use App\Http\Requests\Discount\GetCardByCustomerRequest;
use App\Http\Requests\Discount\GetHistoryOperationsRequest;
use App\Http\Requests\Discount\RebindCardRequest;
use App\Http\Requests\Discount\ReleaseMassFreeCardsRequest;
use App\Http\Requests\Discount\SendRequestActivateRequest;
use App\Http\Resources\Discount\GetCardByCustomerResource;
use App\Http\Resources\Discount\HistoryOperationPaginationResource;
use App\Model\Customer\Service\Telephone\Find\FindTelephoneInterface;
use App\Model\Discount\Service\Card\Activate\ActivateInterface;
use App\Model\Discount\Service\Card\Activate\Data as ActivateCardData;
use App\Model\Discount\Service\Card\BalanceReplenishment\BalanceReplenishmentInterface;
use App\Model\Discount\Service\Card\BalanceReplenishment\Data as BalanceReplenishmentData;
use App\Model\Discount\Service\Card\Deactivate\DeactivateInterface;
use App\Model\Discount\Service\Card\Deactivate\Data as DeactivateCardData;
use App\Model\Discount\Service\Card\Get\ByCustomer\GetCardByCustomerInterface;
use App\Model\Discount\Service\Card\GetBalance\GetBalanceInterface;
use App\Model\Discount\Service\Card\GetBalance\Data as GetBalanceData;
use App\Model\Discount\Service\Card\Rebind\RebindInterface;
use App\Model\Discount\Service\Card\Rebind\Data as RebindCardData;
use App\Model\Discount\Service\CardOperation\GetOperations\GetOperationsInterface;
use App\Model\Discount\Service\CardOperation\GetOperations\Data as GetOperationsData;
use App\Model\Discount\Service\ReleasedCard\ReleaseFreeCard\ReleaseFreeCardInterface;
use App\Model\Discount\Service\ReleasedCard\ReleaseFreeCard\Mass\Data as ReleaseFreeCardDto;
use App\Service\Discount\SendRequestActivate\SendRequestActivateInterface;
use App\Service\Discount\SendRequestActivate\Data as SendRequestActivateData;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DiscountController extends BaseController
{
    private const ADD_BONUSES_ACTIVATE = 10000;

    private GetOperationsInterface $getOperations;
    private ReleaseFreeCardInterface $releaseMassFreeCards;
    private SendRequestActivateInterface $sendRequestActivate;
    private ActivateInterface $activateCard;
    private DeactivateInterface $deactivateCard;
    private GetBalanceInterface $getBalance;
    private BalanceReplenishmentInterface $balanceReplenishment;
    private RebindInterface $rebindCard;
    private FindTelephoneInterface $findTelephone;
    private GetCardByCustomerInterface $getCardByCustomer;

    public function __construct(GetOperationsInterface $getOperations,
                                ReleaseFreeCardInterface $releaseMassFreeCards,
                                SendRequestActivateInterface $sendRequestActivate,
                                ActivateInterface $activateCard,
                                DeactivateInterface $deactivateCard,
                                GetBalanceInterface $getBalance,
                                BalanceReplenishmentInterface $balanceReplenishment,
                                RebindInterface $rebindCard,
                                FindTelephoneInterface $findTelephone,
                                GetCardByCustomerInterface $getCardByCustomer)
    {
        $this->getOperations = $getOperations;
        $this->releaseMassFreeCards = $releaseMassFreeCards;
        $this->sendRequestActivate = $sendRequestActivate;
        $this->activateCard = $activateCard;
        $this->deactivateCard = $deactivateCard;
        $this->getBalance = $getBalance;
        $this->balanceReplenishment = $balanceReplenishment;
        $this->rebindCard = $rebindCard;
        $this->findTelephone = $findTelephone;
        $this->getCardByCustomer = $getCardByCustomer;
    }

    /**
     * @SWG\Get(
     *     path="api/discounts/operations/history",
     *     tags={"Discount"},
     *     @SWG\Parameter(name="page", in="query", required=false, type="integer"),
     *     @SWG\Parameter(name="limit", in="query", required=false, type="integer"),
     *     @SWG\Parameter(name="type", in="query", required=false, type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Get history operations",
     *         @SWG\Schema(ref="#/definitions/HistoryOperationPaginationResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetHistoryOperationsRequest $request
     * @return HistoryOperationPaginationResource
     */
    public function getHistoryOperationsAction(GetHistoryOperationsRequest $request)
    {
        return new HistoryOperationPaginationResource($this->getOperations->getOperations(new GetOperationsData(
            $request->query->get('page'),
            $request->query->get('limit'),
            $request->query->get('type'),
        )));
    }

    /**
     * @SWG\Post(
     *     path="api/discounts/released_cards/release_mass",
     *     tags={"Discount"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ReleaseMassFreeCardsRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Release mass free cards",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param ReleaseMassFreeCardsRequest $request
     * @return JsonResponse
     */
    public function releaseMassFreeCardsAction(ReleaseMassFreeCardsRequest $request)
    {
        try {
            $result = $this->releaseMassFreeCards->release(new ReleaseFreeCardDto(
                $request->request->get('start'),
                $request->request->get('end'),
            ));
            return new JsonResponse($result);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @SWG\Post(
     *     path="api/discounts/cards/send_request_activate",
     *     tags={"Discount"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SendRequestActivateRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Send request activate card",
     *         @SWG\Schema(
     *          @SWG\Property(property="customerTelephoneId", type="integer")
     *         )
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param SendRequestActivateRequest $request
     * @return JsonResponse
     */
    public function sendRequestActivateAction(SendRequestActivateRequest $request)
    {
        try {
            $result = $this->sendRequestActivate->sendRequest(new SendRequestActivateData(
                $request->request->get('cardId'),
                $request->request->get('telephone'),
                $request->user()->user_id,
                $request->request->get('isSendCode'),
            ));
            return new JsonResponse(["customerTelephoneId" => $result]);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage(), $e);
        }
    }

    /**
     * @SWG\Post(
     *     path="api/discounts/cards/activate",
     *     tags={"Discount"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ActivateCardRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Activate card",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param ActivateCardRequest $request
     * @return JsonResponse
     */
    public function activateCardAction(ActivateCardRequest $request)
    {
        try {
            $result = $this->activateCard->activate(new ActivateCardData(
                $request->request->get('customerTelephoneId'),
                $request->request->get('cardId'),
                $request->request->get('code'),
                $request->user()->user_id,
                self::ADD_BONUSES_ACTIVATE,
            ));
            return new JsonResponse($result);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @SWG\Post(
     *     path="api/discounts/cards/deactivate",
     *     tags={"Discount"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/DeactivateCardRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Deactivate card",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param DeactivateCardRequest $request
     * @return JsonResponse
     */
    public function deactivateCardAction(DeactivateCardRequest $request)
    {
        try {
            $result = $this->deactivateCard->deactivate(new DeactivateCardData(
                $request->request->get('telephone'),
                $request->request->get('cardId'),
                $request->request->get('code'),
                $request->user()->user_id
            ));
            return new JsonResponse($result);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @SWG\Post(
     *     path="api/discounts/cards/get_balance",
     *     tags={"Discount"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GetBalanceRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Get balance card",
     *         @SWG\Schema(type="number")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetBalanceRequest $request
     * @return JsonResponse
     */
    public function getBalanceCardAction(GetBalanceRequest $request)
    {
        try {
            $balance = $this->getBalance->balance(new GetBalanceData(
                $request->request->get('telephone'),
                $request->request->get('cardId')
            ));
            return new JsonResponse($balance);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @SWG\Post(
     *     path="api/discounts/cards/get_card_by_customer",
     *     tags={"Discount"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GetBalanceRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Get balance card by customer",
     *         @SWG\Schema(type="number")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetCardByCustomerRequest $request
     * @return GetCardByCustomerResource
     */
    public function getBalanceCardByCustomerAction(GetCardByCustomerRequest $request)
    {
        try {
            $card = $this->getCardByCustomer->get(
                $request->request->get('customerId'),
                $request->request->get('telephone')
            );
            return new GetCardByCustomerResource($card);
        } catch (Exception $e) {
            return null;
//            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @SWG\Post(
     *     path="api/discounts/cards/balance_replenishment",
     *     tags={"Discount"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BalanceReplenishmentRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Get balance card",
     *         @SWG\Schema(type="number")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param BalanceReplenishmentRequest $request
     * @return JsonResponse
     */
    public function replenishmentBalanceCardAction(BalanceReplenishmentRequest $request)
    {
        try {
            $result = $this->balanceReplenishment->replenishment(new BalanceReplenishmentData(
                $request->request->get('cardId'),
                $request->request->get('telephone'),
                $request->request->get('bonuses'),
                $request->request->get('comment') ?? '',
                $request->user()->user_id
            ));
            return new JsonResponse($result);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * @SWG\Post(
     *     path="api/discounts/cards/rebind",
     *     tags={"Discount"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/RebindCardRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Rebind card",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param RebindCardRequest $request
     * @return JsonResponse
     */
    public function rebindCardAction(RebindCardRequest $request)
    {
        try {
            $customerTelephone = $this->findTelephone->find($request->request->get('telephone'));
            if (!$customerTelephone) {
                throw new NotFoundHttpException("Customer telephone not found");
            }
            $result = $this->rebindCard->rebind(new RebindCardData(
                $customerTelephone->customer_telephone_id,
                $request->request->get('cardId'),
                $request->request->get('code'),
                $request->user()->user_id,
                $customerTelephone->customer_id,
            ));
            return new JsonResponse($result);
        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}
