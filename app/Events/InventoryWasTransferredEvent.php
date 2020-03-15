<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\Clinic;
use App\Models\Admin\InventoryTransfer;
use App\Models\Admin\ClinicInventory;

class InventoryWasTransferredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $clinic, $inventory_transfer, $clinic_inventory;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Clinic $clinic, InventoryTransfer $inventory_transfer, ClinicInventory $clinic_inventory)
    {
        $this->clinic = $clinic;
        $this->inventory_transfer = $inventory_transfer;
        $this->clinic_inventory = $clinic_inventory;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
