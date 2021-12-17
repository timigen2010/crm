<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Menu\MenuController;
use App\Model\Menu\Service\Delete\MenuDelete;
use App\Model\Menu\Service\Delete\MenuDeleteInterface;
use App\Model\Menu\Service\Factory\MenuFactory;
use App\Model\Menu\Service\Factory\MenuFactoryInterface;
use App\Model\Menu\Service\Get\GetMenus;
use App\Model\Menu\Service\Get\GetMenusInterface;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(MenuController::class)
            ->needs(MenuFactoryInterface::class)
            ->give(MenuFactory::class);

        $this->app->when(MenuController::class)
            ->needs(MenuDeleteInterface::class)
            ->give(MenuDelete::class);

        $this->app->when(MenuController::class)
            ->needs(GetMenusInterface::class)
            ->give(GetMenus::class);
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
