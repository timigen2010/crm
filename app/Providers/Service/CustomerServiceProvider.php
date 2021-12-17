<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\Customer\CustomerGroupController;
use App\Http\Controllers\Api\Customer\CustomerTelephoneController;
use App\Model\Customer\Service\Factory\CustomerFactory;
use App\Model\Customer\Service\Factory\CustomerFactoryAbstract;
use App\Model\Customer\Service\Get\GetCustomersByParams\GetCustomersByParams;
use App\Model\Customer\Service\Get\GetCustomersInterface;
use App\Model\Customer\Service\Group\Delete\CustomerGroupDelete;
use App\Model\Customer\Service\Group\Delete\CustomerGroupDeleteInterface;
use App\Model\Customer\Service\Group\Factory\CustomerGroupFactory;
use App\Model\Customer\Service\Group\Factory\CustomerGroupFactoryAbstract;
use App\Model\Customer\Service\Group\Get\GetCustomerGroupsInterface;
use App\Model\Customer\Service\Group\Get\Groups\GetCustomerGroups;
use App\Model\Customer\Service\Telephone\Find\FindTelephones;
use App\Model\Customer\Service\Telephone\Find\FindTelephonesInterface;
use App\Model\Order\Service\Get\GetLastByCustomer\GetLastOrderByCustomer;
use App\Model\Order\Service\Get\GetOrdersInterface;
use App\Service\Customer\CreateUpdate\CreateUpdateCustomer;
use App\Service\Customer\CreateUpdate\CreateUpdateCustomerInterface;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(CustomerGroupController::class)
            ->needs(CustomerGroupFactoryAbstract::class)
            ->give(CustomerGroupFactory::class);

        $this->app->when(CustomerGroupController::class)
            ->needs(CustomerGroupDeleteInterface::class)
            ->give(CustomerGroupDelete::class);

        $this->app->when(CustomerGroupController::class)
            ->needs(GetCustomerGroupsInterface::class)
            ->give(GetCustomerGroups::class);

        $this->app->when(CreateUpdateCustomer::class)
            ->needs(CustomerFactoryAbstract::class)
            ->give(CustomerFactory::class);

        $this->app->when(CustomerController::class)
            ->needs(GetCustomersInterface::class)
            ->give(GetCustomersByParams::class);

        $this->app->when(CustomerController::class)
            ->needs(CreateUpdateCustomerInterface::class)
            ->give(CreateUpdateCustomer::class);

        $this->app->when(CustomerTelephoneController::class)
            ->needs(FindTelephonesInterface::class)
            ->give(FindTelephones::class);

        $this->app->when(CustomerController::class)
            ->needs(GetOrdersInterface::class)
            ->give(GetLastOrderByCustomer::class);

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
