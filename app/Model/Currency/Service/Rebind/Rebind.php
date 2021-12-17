<?php

namespace App\Model\Currency\Serivce\Rebind;

use App\Model\Currency\Entity\Currency;
use App\Model\Currency\Repository\CurrencyRepository;
use Illuminate\Support\Facades\DB;

class Rebind implements RebindInterface
{
    private CurrencyRepository $repository;

    public function __construct(CurrencyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function rebind(Currency $currency)
    {
        DB::transaction(function () use ($currency) {
            /** @var Currency $currentDefaultCurrency */
            $currentDefaultCurrency = $this->repository->findOneBy(["main_currency_id" => null]);
            $currency->main_currency_id = null;
            $currentDefaultCurrency->main_currency_id = $currency->currency_id;
            $currentDefaultCurrency->value = $currentDefaultCurrency->value / $currency->value;
            $currency->value = 1;
            $currentDefaultCurrency->save();
            $currency->save();
        });
    }
}
