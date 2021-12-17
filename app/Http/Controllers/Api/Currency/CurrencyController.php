<?php

namespace App\Http\Controllers\Api\Currency;

use App\Http\Requests\Currency\CurrencyRequest;
use App\Http\Requests\Currency\GetCurrenciesRequest;
use App\Http\Resources\Currency\CurrenciesResource;
use App\Http\Resources\Currency\CurrencyResource;
use App\Model\Currency\Entity\Currency;
use App\Model\Currency\Serivce\Delete\CurrencyDeleteInterface;
use App\Model\Currency\Serivce\Rebind\RebindInterface;
use App\Model\Currency\Serivce\RefreshExchangeRate\RefreshExchangeRateInterface;
use App\Model\Currency\Service\Factory\CurrencyFactoryInterface;
use App\Model\Currency\Service\Factory\Data as CurrencyFactoryData;
use App\Model\Currency\Service\Get\GetCurrencyInterface;
use App\Model\Currency\Service\Get\GetCurrencies\Data as GetCurrenciesData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CurrencyController extends BaseController
{
    private CurrencyFactoryInterface $currencyFactory;

    private CurrencyDeleteInterface $currencyDelete;

    private GetCurrencyInterface $getCurrencies;

    private RebindInterface $rebind;

    private RefreshExchangeRateInterface $refreshExchangeRate;

    public function __construct(CurrencyFactoryInterface $currencyFactory,
                                CurrencyDeleteInterface $currencyDelete,
                                GetCurrencyInterface $getCurrencies,
                                RebindInterface $rebind,
                                RefreshExchangeRateInterface $refreshExchangeRate)
    {
        $this->currencyFactory = $currencyFactory;
        $this->currencyDelete = $currencyDelete;
        $this->getCurrencies = $getCurrencies;
        $this->rebind = $rebind;
        $this->refreshExchangeRate = $refreshExchangeRate;
    }

    /**
     * @SWG\Post(
     *     path="api/currencies/new",
     *     tags={"Currencies"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CurrencyRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create currency",
     *         @SWG\Schema(ref="#/definitions/CurrencyResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CurrencyRequest $request
     * @return CurrencyResource
     */
    public function createAction(CurrencyRequest $request)
    {
        $currency = $this->currencyFactory->create(new CurrencyFactoryData(
            $request->request->get('mainCurrencyId'),
            $request->request->get('code'),
            $request->request->get('decimalPlace'),
            $request->request->get('value'),
            $request->request->get('status'),
            $request->request->get('descriptions') ?? [],
        ));
        return new CurrencyResource($currency);
    }

    /**
     * @SWG\Put(
     *     path="api/currencies/{currency_id}/edit",
     *     tags={"Currencies"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CurrencyRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit currency by id",
     *         @SWG\Schema(ref="#/definitions/CurrencyResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Currency $currency
     * @param CurrencyRequest $request
     * @return CurrencyResource
     */
    public function editAction(Currency $currency, CurrencyRequest $request)
    {
        $currency = $this->currencyFactory->create(new CurrencyFactoryData(
            $request->request->get('mainCurrencyId'),
            $request->request->get('code'),
            $request->request->get('decimalPlace'),
            $request->request->get('value'),
            $request->request->get('status'),
            $request->request->get('descriptions') ?? [],
        ), $currency);
        return new CurrencyResource($currency);
    }

    /**
     * @SWG\Delete(
     *     path="api/currencies/{currency_id}/delete",
     *     tags={"Currencies"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete currency by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Currency $currency
     * @return JsonResponse
     */
    public function deleteAction(Currency $currency)
    {
        $this->currencyDelete->delete($currency);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/currencies",
     *     tags={"Currencies"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GetCurrenciesRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Get all currencyes",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/CurrenciesResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetCurrenciesRequest $request
     * @return AnonymousResourceCollection
     */
    public function getCurrenciesAction(GetCurrenciesRequest $request)
    {
        return CurrenciesResource::collection($this->getCurrencies->getCurrencies(new GetCurrenciesData(
            $request->query->get('languageId'),
            $request->query->get('orderBy'),
            $request->query->get('orderDirection'),
        )));
    }

    /**
     * @SWG\Get(
     *     path="api/currencies/{currency_id}/show",
     *     tags={"Currencies"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show currency by id",
     *         @SWG\Schema(ref="#/definitions/CurrencyResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Currency $currency
     * @return CurrencyResource
     */
    public function getShowAction(Currency $currency)
    {
        if ($currency->deleted) {
            throw new NotFoundHttpException('Currency not found');
        }
        return new CurrencyResource($currency);
    }

    /**
     * @SWG\Post(
     *     path="api/currencies/{currency_id}/rebind",
     *     tags={"Currencies"},
     *     @SWG\Response(
     *         response=200,
     *         description="Rebind currency by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Currency $currency
     * @return JsonResponse
     */
    public function rebindAction(Currency $currency)
    {
        $this->rebind->rebind($currency);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Post(
     *     path="api/currencies/refresh_exchange_rate",
     *     tags={"Currencies"},
     *     @SWG\Response(
     *         response=200,
     *         description="Create customer",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return JsonResponse
     */
    public function refreshExchangeRateAction()
    {
        $this->refreshExchangeRate->refresh();
        return new JsonResponse(true);
    }
}
