<?php

namespace App\Listeners;

use App\Events\SuperAdminWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;

class SendSuperAdminCreatedNotification
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
     * @param  SuperAdminWasCreatedEvent  $event
     * @return void
     */
    public function handle(SuperAdminWasCreatedEvent $event)
    {
        $admin = $event->admin;

        $info = array(
            'to' => $admin->email,
            'from' => 'no-reply@innerbeauty.com',
            'subject' => 'Super-Admin Registration Successful | Inner Beauty',
            'template' => 'emails.admin_create',
            'data' => [
                'name' =>  $admin->name,
                'email' => $admin->email,
                'password' => $event->request->input('password'),
                'login_url' => url('/')
            ]
        );

        Mail::send($info['template'], ["data"=> $info['data'], function ($message) use ($info) {
            $message->to($info['to']);
            $message->from($info['from']);
            $message->subject($info['subject']);
        });
    }
}
