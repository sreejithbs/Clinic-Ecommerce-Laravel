<?php

namespace App\Listeners;

use App\Events\InventoryWasTransferredEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;

class SendInventoryTransferredNotification
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
     * @param  InventoryWasTransferredEvent  $event
     * @return void
     */
    public function handle(InventoryWasTransferredEvent $event)
    {
        $clinic = $event->clinic;
        $inventory_transfer = $event->inventory_transfer;
        $clinic_inventory = $event->clinic_inventory;

        $info = array(
            'to' => $clinic->email,
            'from' => 'no-reply@innerbeauty.com',
            'subject' => 'Clinic Inventory Transfer | Inner Beauty',
            'template' => 'emails.inventory_transfer_clinic',
            'data' => [
                'name' =>  $clinic->name,
                'clinic_name' =>  $clinic->clinic_profile->clinicName,
                'transfer_reference_num' =>  $inventory_transfer->transferRefNum,
                'product_name' => $clinic_inventory->product->title,
                'new_qty' => $inventory_transfer->quantity,
                'total_qty' => $clinic_inventory->stockQuantity
            ]
        );

        Mail::send($info['template'], ["data"=> $info['data']], function ($message) use ($info) {
            $message->to($info['to']);
            $message->from($info['from']);
            $message->subject($info['subject']);
        });
    }
}
