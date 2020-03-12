<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\ClinicWasActivatedEvent;
use App\Listeners\SendClinicCreatedNotification;
use App\Events\AdminWasCreatedEvent;
use App\Listeners\SendAdminCreatedNotification;

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
        ClinicWasActivatedEvent::class => [
            SendClinicCreatedNotification::class,
        ],
        AdminWasCreatedEvent::class => [
            SendAdminCreatedNotification::class,
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
