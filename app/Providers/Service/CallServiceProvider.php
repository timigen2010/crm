<?php

namespace App\Providers\Service;

use App\Http\Controllers\OpenApi\Call\SetCallEventController as OpenApiSetCallEventController;
use App\Model\Call\Repository\CallActivityRepository;
use App\Model\Call\Service\CheckCall\CheckCall;
use App\Model\Call\Service\Factory\CallActivityFactory;
use App\Model\Call\Service\Factory\CallActivityFactoryAbstract;
use App\Model\Call\Service\SetCallEvent\GetPhoneEntity\GetPhoneEntity;
use App\Model\Call\Service\SetCallEvent\GetPhoneEntity\GetPhoneEntityInterface;
use App\Model\Call\Service\SetCallEvent\SetCallEvent;
use App\Model\Call\Service\SetCallEvent\SetCallEventInterface;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetBEDial;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetBEDialInterface;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetBridge;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetHangup;
use App\Model\Company\Service\Phoneline\Get\GetCompanyPhonelinesInterface;
use App\Model\Company\Service\Phoneline\Get\Phonelines\GetCompanyPhonelines;
use App\Model\Customer\Service\Factory\CustomerFactory;
use App\Model\Customer\Service\Factory\CustomerFactoryAbstract;
use App\Model\Customer\Service\Telephone\Find\FindTelephone;
use App\Model\Customer\Service\Telephone\Find\FindTelephoneInterface;
use App\Model\User\Service\SipPhone\Find\FindSipPhone;
use App\Model\User\Service\SipPhone\Find\FindSipPhoneInterface;
use App\Service\Phone\Clean\CleanPhone;
use App\Service\Phone\Clean\CleanPhoneInterface;
use Illuminate\Support\ServiceProvider;

class CallServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->when(OpenApiSetCallEventController::class)
            ->needs(SetCallEventInterface::class)
            ->give(SetCallEvent::class);

        $this->app->when(GetPhoneEntity::class)
            ->needs(FindSipPhoneInterface::class)
            ->give(FindSipPhone::class);

        $this->app->when(GetPhoneEntity::class)
            ->needs(FindTelephoneInterface::class)
            ->give(FindTelephone::class);

        $this->app->when(GetPhoneEntity::class)
            ->needs(CleanPhoneInterface::class)
            ->give(CleanPhone::class);

        $this->app->when(GetPhoneEntity::class)
            ->needs(CustomerFactoryAbstract::class)
            ->give(CustomerFactory::class);

        $this->app->when(SetCallEvent::class)
            ->needs(GetCompanyPhonelinesInterface::class)
            ->give(GetCompanyPhonelines::class);

        $this->app->when(SetCallEvent::class)
            ->needs(SetBEDialInterface::class)
            ->give(SetBEDial::class);

        $this->app->when(SetCallEvent::class)
            ->needs(GetPhoneEntityInterface::class)
            ->give(GetPhoneEntity::class);

        $this->app->when(SetCallEvent::class)
            ->needs(CleanPhoneInterface::class)
            ->give(CleanPhone::class);

        $this->app->when(SetCallEvent::class)
            ->needs(CallActivityRepository::class)
            ->give(CallActivityRepository::class);

        $this->app->when(SetCallEvent::class)
            ->needs(CallActivityFactoryAbstract::class)
            ->give(CallActivityFactory::class);

        $this->app->when(SetBEDial::class)
            ->needs(GetPhoneEntityInterface::class)
            ->give(GetPhoneEntity::class);

        $this->app->when(SetBEDial::class)
            ->needs(CallActivityFactoryAbstract::class)
            ->give(CallActivityFactory::class);

        $this->app->when(SetBridge::class)
            ->needs(CleanPhoneInterface::class)
            ->give(CleanPhone::class);

        $this->app->when(SetBEDial::class)
            ->needs(CleanPhoneInterface::class)
            ->give(CleanPhone::class);

        $this->app->when(SetHangup::class)
            ->needs(CleanPhoneInterface::class)
            ->give(CleanPhone::class);

        $this->app->when(CheckCall::class)
            ->needs(CustomerFactoryAbstract::class)
            ->give(CustomerFactory::class);

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
