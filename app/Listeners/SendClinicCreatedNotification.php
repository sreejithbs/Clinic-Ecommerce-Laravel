<?php

namespace App\Listeners;

use App\Events\ClinicWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;

class SendClinicCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ClinicWasCreatedEvent  $event
     * @return void
     */
    public function handle(ClinicWasCreatedEvent $event)
    {
        // EMAIL TODO
        // $clinic = $event->clinic;

        // $data = array('a' => $clinic->b);
        // Mail::send('emails.xyz', $data, function ($message) use ($clinic) {
        //         $message->from('hi@demo.com', 'John Doe');
        //         $message->subject('Test Subject');
        //         $message->to($clinic->email);
        // });
    }
}
