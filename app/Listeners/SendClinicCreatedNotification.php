<?php

namespace App\Listeners;

use App\Events\ClinicWasActivatedEvent;
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
     * @param  ClinicWasActivatedEvent  $event
     * @return void
     */
    public function handle(ClinicWasActivatedEvent $event)
    {
        $clinic = $event->clinic;

        $info = array(
            'to' => $clinic->email,
            'from' => 'no-reply@innerbeauty.com',
            'subject' => 'Clinic Registration Successful | Inner Beauty',
            'template' => 'emails.clinic_create',
            'data' => [
                'name' =>  $clinic->name,
                'clinic_name' =>  $clinic->clinic_profile->clinicName,
                'clinic_reference_num' =>  $clinic->clinic_profile->clinicRefNum,
                'email' => $clinic->email,
                'password' => $event->password,
                'login_url' => url('/')
            ]
        );

        Mail::send($info['template'], ["data"=> $info['data']], function ($message) use ($info) {
            $message->to($info['to']);
            $message->from($info['from']);
            $message->subject($info['subject']);
        });
    }
}
