<?php

namespace App\Listeners;

use App\Events\RepairStatusChanged;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationToClient implements ShouldQueue
{
    use InteractsWithQueue;

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(RepairStatusChanged $event)
    {
        $message = "Статус заявки #{$event->repairRequest->id} змінено: {$event->newStatus}";

        $this->notificationService->sendStatusNotification(
            $event->repairRequest->id,
            $message
        );
    }
}
