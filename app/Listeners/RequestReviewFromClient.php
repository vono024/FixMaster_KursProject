<?php

namespace App\Listeners;

use App\Events\RepairCompleted;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RequestReviewFromClient implements ShouldQueue
{
    use InteractsWithQueue;

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(RepairCompleted $event)
    {
        $this->notificationService->sendReviewRequest($event->repairRequest->id);
    }
}
