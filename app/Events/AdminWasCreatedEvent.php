<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminWasCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $admin, $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Admin $admin, Request $request)
    {
        $this->admin = $admin;
        $this->request = $request;
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
