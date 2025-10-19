<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\RepairRequest;

class NotificationService
{
    public function sendStatusNotification(int $repairRequestId, string $message)
    {
        $repair = RepairRequest::findOrFail($repairRequestId);

        Notification::create([
            'user_id' => $repair->client_id,
            'repair_request_id' => $repairRequestId,
            'type' => 'status_change',
            'message' => $message,
            'is_read' => false,
            'sent_at' => now(),
        ]);
    }

    public function sendToMaster(int $masterId, int $repairRequestId, string $message)
    {
        Notification::create([
            'user_id' => $masterId,
            'repair_request_id' => $repairRequestId,
            'type' => 'new_assignment',
            'message' => $message,
            'is_read' => false,
            'sent_at' => now(),
        ]);
    }

    public function sendReviewRequest(int $repairRequestId)
    {
        $repair = RepairRequest::findOrFail($repairRequestId);

        Notification::create([
            'user_id' => $repair->client_id,
            'repair_request_id' => $repairRequestId,
            'type' => 'review_request',
            'message' => 'Будь ласка, залишіть відгук про виконану роботу',
            'is_read' => false,
            'sent_at' => now(),
        ]);
    }

    public function markAsRead(int $notificationId)
    {
        Notification::where('id', $notificationId)
            ->where('user_id', auth()->id())
            ->update(['is_read' => true]);
    }

    public function getUnreadCount(int $userId)
    {
        return Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->count();
    }
}
