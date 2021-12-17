<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapOpenApiUserRoutes();
        $this->mapApiProductRoutes();
        $this->mapApiCompanyRoutes();
        $this->mapApiMenuRoutes();
        $this->mapApiUnitClassesRoutes();
        $this->mapApiWeightClassesRoutes();
        $this->mapApiCurrenciesRoutes();
        $this->mapOpenApiCallRoutes();
        $this->mapOpenApiDBRoutes();
        $this->mapApiLanguagesRoutes();
        $this->mapApiDiscountRoutes();
        $this->mapApiOrderRoutes();
        $this->mapApiCustomerRoutes();
        $this->mapApiReports();
        $this->mapOpenApiForeignRoutes();
        $this->mapApiCouriers();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
//             ->middleware(['api', 'auth:api', 'check.permission'])
             ->middleware(['api', 'auth:api'])
             ->namespace($this->namespace)
             ->group(base_path('routes/api/api.php'));
    }

    protected function mapOpenApiUserRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/open_api_user.php'));
    }

    protected function mapOpenApiCallRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/open_api_call.php'));
    }

    protected function mapOpenApiDBRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/open_api_db.php'));
    }

    protected function mapApiProductRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_product.php'));
    }

    protected function mapApiCompanyRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api', 'check.permission'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_company.php'));
    }

    protected function mapApiMenuRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api', 'check.permission'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_menu.php'));
    }

    protected function mapApiUnitClassesRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api', 'check.permission'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_unit_class.php'));
    }

    protected function mapApiWeightClassesRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api', 'check.permission'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_weight_class.php'));
    }

    protected function mapApiCurrenciesRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api', 'check.permission'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_currency.php'));
    }

    protected function mapApiLanguagesRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api', 'check.permission'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_language.php'));
    }

    protected function mapApiDiscountRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api', 'check.permission'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_discount.php'));
    }

    protected function mapApiOrderRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api', 'check.permission'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_order.php'));
    }

    protected function mapApiCustomerRoutes()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api', 'check.permission'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_customer.php'));
    }

    protected function mapApiReports()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_report.php'));
    }

    protected function mapOpenApiForeignRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/open_api_foreign.php'));
    }

    protected function mapApiCouriers()
    {
        Route::prefix('api')
            ->middleware(['api', 'auth:api', 'check.permission'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api_courier.php'));
    }
}
