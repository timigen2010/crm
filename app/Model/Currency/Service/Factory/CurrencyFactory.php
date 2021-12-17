<?php

namespace App\Model\Currency\Service\Factory;

use App\Model\Currency\Entity\Currency;
use App\Model\Currency\Serivce\Rebind\RebindInterface;

class CurrencyFactory implements CurrencyFactoryInterface
{
    private RebindInterface $rebind;

    public function __construct(RebindInterface $rebind)
    {
        $this->rebind = $rebind;
    }

    public function create(Data $data, ?Currency $currency = null): Currency
    {
        $currency = $currency ?? new Currency();
        $currency->deleted = false;
        $currency->value = $data->value;
        $currency->main_currency_id = $data->mainCurrencyId;
        $currency->code = $data->code;
        $currency->decimal_place = $data->decimalPlace;
        $currency->status = $data->status;
        $currency->descriptions()->delete();
        $currency->save();
        foreach ($data->descriptions as $description) {
            $currency->descriptions()->insert([
                'currency_id' => $currency->currency_id,
                'language_id' => $description['languageId'],
                'name' => $description['name'],
                'symbol_left' => $description['symbolLeft'],
                'symbol_right' => $description['symbolRight']
            ]);
        }
        if (!$currency->main_currency_id) {
            $this->rebind->rebind($currency);
        }
        return $currency;
    }
}
