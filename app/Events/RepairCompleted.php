<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\RepairRequest;

class RepairCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $repairRequest;

    public function __construct(RepairRequest $repairRequest)
    {
        $this->repairRequest = $repairRequest;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('repair.' . $this->repairRequest->id);
    }
}
