<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Order\OrderController;
use App\Model\DB\Service\DispatchingSync\DispatchingDBSync;
use App\Model\DB\Service\DispatchingSync\DispatchingDBSyncInterface;
use App\Model\Discount\Service\CardOperation\Factory\CardOperationFactory;
use App\Model\Discount\Service\CardOperation\Factory\CardOperationFactoryInterface;
use App\Model\Discount\Service\CardTransaction\Factory\CardTransactionFactory;
use App\Model\Discount\Service\CardTransaction\Factory\CardTransactionFactoryInterface;
use App\Model\Order\Service\Action\OrderActionFactory;
use App\Model\Order\Service\Action\OrderActionFactoryInterface;
use App\Model\Order\Service\CookComment\Factory\OrderCookCommentFactory;
use App\Model\Order\Service\CookComment\Factory\OrderCookCommentFactoryInterface;
use App\Model\Order\Service\Courier\Factory\OrderCourierFactory;
use App\Model\Order\Service\Courier\Factory\OrderCourierFactoryInterface;
use App\Model\Order\Service\CreateUpdate\CreateUpdateOrder;
use App\Model\Order\Service\CreateUpdate\CreateUpdateOrderInterface;
use App\Model\Order\Service\Customer\Factory\OrderCustomerFactory;
use App\Model\Order\Service\Customer\Factory\OrderCustomerFactoryInterface;
use App\Model\Order\Service\DeliveryTime\Factory\OrderDeliveryTimeFactory;
use App\Model\Order\Service\DeliveryTime\Factory\OrderDeliveryTimeFactoryInterface;
use App\Model\Order\Service\Factory\OrderFactory;
use App\Model\Order\Service\Factory\OrderFactoryInterface;
use App\Model\Order\Service\Get\GetByParams\GetOrders;
use App\Model\Order\Service\Get\GetLastByCustomer\GetLastOrderByCustomer;
use App\Model\Order\Service\Get\GetOrdersInterface;
use App\Model\Order\Service\History\Factory\OrderHistoryFactory;
use App\Model\Order\Service\History\Factory\OrderHistoryFactoryInterface;
use App\Model\Order\Service\OrderOption\Factory\OrderOptionFactory;
use App\Model\Order\Service\OrderOption\Factory\OrderOptionFactoryInterface;
use App\Model\Order\Service\Payment\Factory\OrderPaymentFactory;
use App\Model\Order\Service\Payment\Factory\OrderPaymentFactoryInterface;
use App\Model\Order\Service\Product\Factory\OrderProductFactory;
use App\Model\Order\Service\Product\Factory\OrderProductFactoryInterface;
use App\Model\Order\Service\ShowInfo\ShowInfoOrderInterface;
use App\Model\Order\Service\ShowInfo\ShowTotalInfoOrder;
use App\Model\Order\Service\Total\Factory\OrderTotalFactory;
use App\Model\Order\Service\Total\Factory\OrderTotalFactoryInterface;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(OrderController::class)
            ->needs(CreateUpdateOrderInterface::class)
            ->give(CreateUpdateOrder::class);

        $this->app->when(OrderController::class)
            ->needs(GetOrdersInterface::class)
            ->give(GetOrders::class);

        $this->app->when(OrderController::class)
            ->needs(ShowInfoOrderInterface::class)
            ->give(ShowTotalInfoOrder::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderFactoryInterface::class)
            ->give(OrderFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderCustomerFactoryInterface::class)
            ->give(OrderCustomerFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderPaymentFactoryInterface::class)
            ->give(OrderPaymentFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderCourierFactoryInterface::class)
            ->give(OrderCourierFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderCookCommentFactoryInterface::class)
            ->give(OrderCookCommentFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderDeliveryTimeFactoryInterface::class)
            ->give(OrderDeliveryTimeFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderProductFactoryInterface::class)
            ->give(OrderProductFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderOptionFactoryInterface::class)
            ->give(OrderOptionFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderTotalFactoryInterface::class)
            ->give(OrderTotalFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderHistoryFactoryInterface::class)
            ->give(OrderHistoryFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(OrderActionFactoryInterface::class)
            ->give(OrderActionFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(CardOperationFactoryInterface::class)
            ->give(CardOperationFactory::class);

        $this->app->when(CreateUpdateOrder::class)
            ->needs(CardTransactionFactoryInterface::class)
            ->give(CardTransactionFactory::class);

        $this->app->when(GetLastOrderByCustomer::class)
            ->needs(ShowInfoOrderInterface::class)
            ->give(ShowTotalInfoOrder::class);
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
