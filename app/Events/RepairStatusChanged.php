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

class RepairStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $repairRequest;
    public $oldStatus;
    public $newStatus;

    public function __construct(RepairRequest $repairRequest, string $oldStatus, string $newStatus)
    {
        $this->repairRequest = $repairRequest;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('repair.' . $this->repairRequest->id);
    }
}
