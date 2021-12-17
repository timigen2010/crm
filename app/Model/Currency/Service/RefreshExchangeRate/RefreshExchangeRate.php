<?php

namespace App\Model\Currency\Serivce\RefreshExchangeRate;

use App\Model\Currency\Entity\Currency;
use App\Model\Currency\Repository\CurrencyRepository;
use Aveiv\OpenExchangeRatesApi\Client;
use Aveiv\OpenExchangeRatesApi\Exception\Exception;
use Illuminate\Support\Facades\DB;

class RefreshExchangeRate implements RefreshExchangeRateInterface
{
    private Client $client;

    private CurrencyRepository $repository;

    public function __construct(Client $client, CurrencyRepository $repository)
    {
        $this->client = $client;
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function refresh()
    {
        $currencies = $this->repository->findBy(['deleted' => false]);
        $symbols = $currencies->map(fn(Currency $currency) => strtoupper($currency->code))->toArray();
        if ($symbols) {
            $rates = $this->client->getLatest('USD', $symbols);
            DB::transaction(function () use ($rates, $currencies) {
                $currencies->each(function (Currency $currency) use ($rates) {
                    if ([$rate, $rateMain] = $this->checkAndReturnRates($currency, $rates)) {
                        $currency->value = $rate / $rateMain;
                        $currency->save();
                    }
                });
            });
        }
    }

    private function checkAndReturnRates(Currency $currency, array $rates)
    {
        if (
            $currency->main_currency_id &&
            ($rate = $rates['rates'][strtoupper($currency->code)]) &&
            ($rateMain = $currency->mainCurrency ? $rates['rates'][strtoupper($currency->mainCurrency->code)] : 1)
        ) {
            return [$rate, $rateMain];
        }
        return false;
    }
}
