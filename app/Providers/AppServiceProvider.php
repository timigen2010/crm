<?php

namespace App\Providers;

use App\Http\Controllers\Api\Call\CallActivityController;
use App\Http\Controllers\Api\Courier\CourierController;
use App\Http\Controllers\Api\DirectoryController;
use App\Http\Controllers\OpenApi\DB\DBSyncController;
use App\Model\Call\Service\CheckCall\CheckCall;
use App\Model\Call\Service\CheckCall\CheckCallInterface;
use App\Model\Call\Service\Factory\CallActivityFactory;
use App\Model\Call\Service\Factory\CallActivityFactoryAbstract;
use App\Model\Call\Service\Get\GetCallActivitiesInterface;
use App\Model\Call\Service\Get\GetCallsByParams\GetCallsByParams;
use App\Model\Courier\Service\Get\ByCompany\GetCouriersByCompanyInterface;
use App\Model\Courier\Service\Get\ByCompany\GetCouriersByCompany;
use App\Model\DB\Service\ReceivingSync\ReceivingDBSync;
use App\Model\DB\Service\ReceivingSync\ReceivingDBSyncInterface;
use App\Service\Directory\GetDirectories\GetDirectories;
use App\Service\Directory\GetDirectories\GetDirectoriesInterface;
use Aveiv\OpenExchangeRatesApi\Client;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }

        Passport::ignoreMigrations();

        $this->app->when(CallActivityController::class)
            ->needs(CallActivityFactoryAbstract::class)
            ->give(CallActivityFactory::class);

        $this->app->when(CallActivityController::class)
            ->needs(GetCallActivitiesInterface::class)
            ->give(GetCallsByParams::class);

        $this->app->when(CallActivityController::class)
            ->needs(CheckCallInterface::class)
            ->give(CheckCall::class);

        $this->app->when(DirectoryController::class)
            ->needs(GetDirectoriesInterface::class)
            ->give(GetDirectories::class);

        $this->app->bind(Client::class, function() {
            return new Client(config('services.open_exchange_rates.api_id'));
        });

        $this->app->when(CourierController::class)
            ->needs(GetCouriersByCompanyInterface::class)
            ->give(GetCouriersByCompany::class);
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
