<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\ClinicWasCreatedEvent;
use App\Listeners\SendClinicCreatedNotification;
use App\Events\SuperAdminWasCreatedEvent;
use App\Listeners\SendSuperAdminCreatedNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ClinicWasCreatedEvent::class => [
            SendClinicCreatedNotification::class,
        ],
        SuperAdminWasCreatedEvent::class => [
            SendSuperAdminCreatedNotification::class,
        ],
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
