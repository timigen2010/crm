<?php

namespace App\Model\Currency\Serivce\Delete;

use App\Model\Currency\Entity\Currency;
use Illuminate\Support\Facades\DB;

class CurrencyDelete implements CurrencyDeleteInterface
{

    public function delete(Currency $currency)
    {
        DB::transaction(function () use ($currency) {
            $currency->deleted = true;
            if ($this->isRebindDefault($currency)) {
               $this->rebindAndRefreshValueDefault($currency);
            }
            if ($this->isRebind($currency)) {
                $this->rebindAndRefreshValue($currency);
            }
            $currency->save();
        });
    }

    private function isRebindDefault(Currency $currency)
    {
        return !$currency->main_currency_id && $currency->children->count();
    }

    private function rebindAndRefreshValueDefault(Currency $currency)
    {
        /** @var Currency $firstChild */
        $firstChild = $currency->children->first();
        $firstChild->main_currency_id = null;
        $currency->children
            ->filter(fn(Currency $currency) => $currency !== $firstChild)
            ->map(function (Currency $childCurrency) use ($firstChild) {
                $childCurrency->main_currency_id = $firstChild->currency_id;
                $childCurrency->value = $childCurrency->value / $firstChild->value;
                $childCurrency->save();
            });
        $firstChild->value = 1;
        $firstChild->save();
    }

    private function isRebind(Currency $currency)
    {
        return $currency->main_currency_id && $currency->children->count();
    }

    private function rebindAndRefreshValue(Currency $currency)
    {
        $currency->children->map(function (Currency $childCurrency) use ($currency) {
                $childCurrency->main_currency_id = $currency->main_currency_id;
                $childCurrency->value = $currency->value * $childCurrency->value;
                $childCurrency->save();
            });
    }
}
