<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\NotificationService;

class SendStatusNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $repairRequestId;
    protected $message;

    public function __construct(int $repairRequestId, string $message)
    {
        $this->repairRequestId = $repairRequestId;
        $this->message = $message;
    }

    public function handle(NotificationService $notificationService)
    {
        $notificationService->sendStatusNotification($this->repairRequestId, $this->message);
    }
}
