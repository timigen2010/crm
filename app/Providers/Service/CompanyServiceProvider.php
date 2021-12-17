<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Company\CompanyController;
use App\Http\Controllers\Api\Company\CompanyPhonelineController;
use App\Http\Controllers\Api\Company\CompanySettingController;
use App\Model\Company\Service\Company\Delete\CompanyDelete;
use App\Model\Company\Service\Company\Delete\CompanyDeleteInterface;
use App\Model\Company\Service\Company\Factory\CompanyFactory;
use App\Model\Company\Service\Company\Factory\CompanyFactoryAbstract;
use App\Model\Company\Service\Company\Get\GetCompanies;
use App\Model\Company\Service\Company\Get\GetCompaniesInterface;
use App\Model\Company\Service\Company\Setting\GetByKey\GetSetting;
use App\Model\Company\Service\Company\Setting\GetByKey\GetSettingInterface as GetSettingByKeyInterface;
use App\Model\Company\Service\Phoneline\Delete\CompanyPhonelineDelete;
use App\Model\Company\Service\Phoneline\Delete\CompanyPhonelineDeleteInterface;
use App\Model\Company\Service\Phoneline\Factory\CompanyPhonelineFactory;
use App\Model\Company\Service\Phoneline\Factory\CompanyPhonelineFactoryAbstract;
use App\Model\Company\Service\Phoneline\Get\GetCompanyPhonelinesInterface;
use App\Model\Company\Service\Phoneline\Get\Phonelines\GetCompanyPhonelines;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(CompanyPhonelineController::class)
            ->needs(CompanyPhonelineFactoryAbstract::class)
            ->give(CompanyPhonelineFactory::class);

        $this->app->when(CompanyPhonelineController::class)
            ->needs(CompanyPhonelineDeleteInterface::class)
            ->give(CompanyPhonelineDelete::class);

        $this->app->when(CompanyPhonelineController::class)
            ->needs(GetCompanyPhonelinesInterface::class)
            ->give(GetCompanyPhonelines::class);

        $this->app->when(CompanyController::class)
            ->needs(CompanyFactoryAbstract::class)
            ->give(CompanyFactory::class);

        $this->app->when(CompanyController::class)
            ->needs(CompanyDeleteInterface::class)
            ->give(CompanyDelete::class);

        $this->app->when(CompanyController::class)
            ->needs(GetCompaniesInterface::class)
            ->give(GetCompanies::class);

        $this->app->when(CompanySettingController::class)
            ->needs(GetSettingByKeyInterface::class)
            ->give(GetSetting::class);
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
