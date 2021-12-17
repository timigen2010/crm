<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Currency\CurrencyController;
use App\Model\Currency\Serivce\Delete\CurrencyDelete;
use App\Model\Currency\Serivce\Delete\CurrencyDeleteInterface;
use App\Model\Currency\Serivce\Rebind\Rebind;
use App\Model\Currency\Serivce\Rebind\RebindInterface;
use App\Model\Currency\Serivce\RefreshExchangeRate\RefreshExchangeRate;
use App\Model\Currency\Serivce\RefreshExchangeRate\RefreshExchangeRateInterface;
use App\Model\Currency\Service\Factory\CurrencyFactory;
use App\Model\Currency\Service\Factory\CurrencyFactoryInterface;
use App\Model\Currency\Service\Get\GetCurrencies\GetCurrencies;
use App\Model\Currency\Service\Get\GetCurrencyInterface;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(CurrencyController::class)
            ->needs(RefreshExchangeRateInterface::class)
            ->give(RefreshExchangeRate::class);

        $this->app->when(CurrencyController::class)
            ->needs(CurrencyFactoryInterface::class)
            ->give(CurrencyFactory::class);

        $this->app->when(CurrencyController::class)
            ->needs(CurrencyDeleteInterface::class)
            ->give(CurrencyDelete::class);

        $this->app->when(CurrencyController::class)
            ->needs(GetCurrencyInterface::class)
            ->give(GetCurrencies::class);

        $this->app->when(CurrencyController::class)
            ->needs(RebindInterface::class)
            ->give(Rebind::class);

        $this->app->when(CurrencyFactory::class)
            ->needs(RebindInterface::class)
            ->give(Rebind::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
