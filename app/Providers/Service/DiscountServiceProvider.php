<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Discount\DiscountController;
use App\Model\Customer\Service\Telephone\Find\FindTelephone;
use App\Model\Customer\Service\Telephone\Find\FindTelephoneInterface;
use App\Model\Discount\Service\Card\Activate\ActivateCard;
use App\Model\Discount\Service\Card\Activate\ActivateInterface;
use App\Model\Discount\Service\Card\BalanceReplenishment\BalanceReplenishment;
use App\Model\Discount\Service\Card\BalanceReplenishment\BalanceReplenishmentInterface;
use App\Model\Discount\Service\Card\Deactivate\DeactivateCard;
use App\Model\Discount\Service\Card\Deactivate\DeactivateInterface;
use App\Model\Discount\Service\Card\Factory\CardFactory;
use App\Model\Discount\Service\Card\Factory\CardFactoryInterface;
use App\Model\Discount\Service\Card\GenerateConfirmCode\GenerateConfirmCode;
use App\Model\Discount\Service\Card\GenerateConfirmCode\GenerateConfirmCodeInterface;
use App\Model\Discount\Service\Card\Get\ByCustomer\GetCardByCustomer;
use App\Model\Discount\Service\Card\Get\ByCustomer\GetCardByCustomerInterface;
use App\Model\Discount\Service\Card\GetBalance\GetBalanceCard;
use App\Model\Discount\Service\Card\GetBalance\GetBalanceInterface;
use App\Model\Discount\Service\Card\Rebind\RebindCard;
use App\Model\Discount\Service\Card\Rebind\RebindInterface;
use App\Model\Discount\Service\Card\Release\ReleaseCard;
use App\Model\Discount\Service\Card\Release\ReleaseInterface;
use App\Model\Discount\Service\CardOperation\Factory\CardOperationFactory;
use App\Model\Discount\Service\CardOperation\Factory\CardOperationFactoryInterface;
use App\Model\Discount\Service\CardOperation\GetOperations\GetHistoryOperations;
use App\Model\Discount\Service\CardOperation\GetOperations\GetOperationsInterface;
use App\Model\Discount\Service\CardTransaction\Factory\CardTransactionFactory;
use App\Model\Discount\Service\CardTransaction\Factory\CardTransactionFactoryInterface;
use App\Model\Discount\Service\ReleasedCard\ReleaseFreeCard\Mass\ReleaseMassFreeCards;
use App\Model\Discount\Service\ReleasedCard\ReleaseFreeCard\ReleaseFreeCardInterface;
use App\Service\Discount\SendRequestActivate\SendRequestActivate;
use App\Service\Discount\SendRequestActivate\SendRequestActivateInterface;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ActivateCard::class)
            ->needs(CardOperationFactoryInterface::class)
            ->give(CardOperationFactory::class);

        $this->app->when(ActivateCard::class)
            ->needs(CardTransactionFactoryInterface::class)
            ->give(CardTransactionFactory::class);

        $this->app->when(ReleaseCard::class)
            ->needs(GenerateConfirmCodeInterface::class)
            ->give(GenerateConfirmCode::class);

        $this->app->when(ReleaseCard::class)
            ->needs(CardFactoryInterface::class)
            ->give(CardFactory::class);

        $this->app->when(SendRequestActivate::class)
            ->needs(ReleaseInterface::class)
            ->give(ReleaseCard::class);

        $this->app->when(DeactivateCard::class)
            ->needs(CardOperationFactoryInterface::class)
            ->give(CardOperationFactory::class);

        $this->app->when(BalanceReplenishment::class)
            ->needs(CardOperationFactoryInterface::class)
            ->give(CardOperationFactory::class);

        $this->app->when(BalanceReplenishment::class)
            ->needs(CardTransactionFactoryInterface::class)
            ->give(CardTransactionFactory::class);

        $this->app->when(RebindCard::class)
            ->needs(CardOperationFactoryInterface::class)
            ->give(CardOperationFactory::class);

        $this->app->when(DiscountController::class)
            ->needs(GetOperationsInterface::class)
            ->give(GetHistoryOperations::class);

        $this->app->when(DiscountController::class)
            ->needs(ReleaseFreeCardInterface::class)
            ->give(ReleaseMassFreeCards::class);

        $this->app->when(DiscountController::class)
            ->needs(SendRequestActivateInterface::class)
            ->give(SendRequestActivate::class);

        $this->app->when(DiscountController::class)
            ->needs(ActivateInterface::class)
            ->give(ActivateCard::class);

        $this->app->when(DiscountController::class)
            ->needs(DeactivateInterface::class)
            ->give(DeactivateCard::class);

        $this->app->when(DiscountController::class)
            ->needs(GetBalanceInterface::class)
            ->give(GetBalanceCard::class);

        $this->app->when(DiscountController::class)
            ->needs(BalanceReplenishmentInterface::class)
            ->give(BalanceReplenishment::class);

        $this->app->when(DiscountController::class)
            ->needs(RebindInterface::class)
            ->give(RebindCard::class);

        $this->app->when(DiscountController::class)
            ->needs(FindTelephoneInterface::class)
            ->give(FindTelephone::class);

        $this->app->when(DiscountController::class)
            ->needs(GetCardByCustomerInterface::class)
            ->give(GetCardByCustomer::class);
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
