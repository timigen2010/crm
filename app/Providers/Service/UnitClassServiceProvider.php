<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Unit\UnitClassController;
use App\Model\Unit\Serivce\Rebind\Rebind;
use App\Model\Unit\Serivce\Rebind\RebindInterface;
use App\Model\Unit\Service\Delete\UnitClassDelete;
use App\Model\Unit\Service\Delete\UnitClassDeleteInterface;
use Illuminate\Support\ServiceProvider;
use App\Model\Unit\Service\Factory\UnitClassFactory;
use App\Model\Unit\Service\Factory\UnitClassFactoryInterface;
use App\Model\Unit\Service\Get\GetUnitClassesInterface;
use App\Model\Unit\Service\Get\GetUnits\GetUnitClasses;

class UnitClassServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(UnitClassController::class)
            ->needs(UnitClassFactoryInterface::class)
            ->give(UnitClassFactory::class);

        $this->app->when(UnitClassController::class)
            ->needs(UnitClassDeleteInterface::class)
            ->give(UnitClassDelete::class);

        $this->app->when(UnitClassController::class)
            ->needs(GetUnitClassesInterface::class)
            ->give(GetUnitClasses::class);

        $this->app->when(UnitClassFactory::class)
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
