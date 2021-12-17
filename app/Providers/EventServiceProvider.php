<?php

namespace App\Providers;

use App\EventListeners\User\AccessToken\AccessTokenCreateListener;
use App\Model\User\Service\Event\PasswordReset;
use App\Model\User\Service\EventListeners\PasswordResetListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Laravel\Passport\Events\AccessTokenCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        AccessTokenCreated::class => [
            AccessTokenCreateListener::class
        ],
        PasswordReset::class => [
            PasswordResetListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
