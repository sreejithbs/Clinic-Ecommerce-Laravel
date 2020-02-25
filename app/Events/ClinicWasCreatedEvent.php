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

class ClinicWasCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $clinic;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Clinic $clinic)
    {
        $this->clinic = $clinic;
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
