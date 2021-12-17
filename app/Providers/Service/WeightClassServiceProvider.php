<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Weight\WeightClassController;
use App\Model\Weight\Serivce\Rebind\Rebind;
use App\Model\Weight\Serivce\Rebind\RebindInterface;
use App\Model\Weight\Service\Delete\WeightClassDelete;
use App\Model\Weight\Service\Delete\WeightClassDeleteInterface;
use Illuminate\Support\ServiceProvider;
use App\Model\Weight\Service\Factory\WeightClassFactory;
use App\Model\Weight\Service\Factory\WeightClassFactoryInterface;
use App\Model\Weight\Service\Get\GetWeightClassesInterface;
use App\Model\Weight\Service\Get\GetWeights\GetWeightClasses;

class WeightClassServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(WeightClassController::class)
            ->needs(WeightClassFactoryInterface::class)
            ->give(WeightClassFactory::class);

        $this->app->when(WeightClassController::class)
            ->needs(WeightClassDeleteInterface::class)
            ->give(WeightClassDelete::class);

        $this->app->when(WeightClassController::class)
            ->needs(GetWeightClassesInterface::class)
            ->give(GetWeightClasses::class);

        $this->app->when(WeightClassController::class)
            ->needs(RebindInterface::class)
            ->give(Rebind::class);

        $this->app->when(WeightClassFactory::class)
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
