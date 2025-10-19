<?php

namespace App\Services;

use App\Models\RepairRequest;
use App\Models\RepairStatus;
use App\Services\NotificationService;

class RepairService
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function createRepair(array $data)
    {
        $data['client_id'] = auth()->id();
        $data['status'] = 'new';

        $repair = RepairRequest::create($data);

        $this->logStatusChange($repair, 'new', 'Заявка створена');

        return $repair;
    }

    public function assignMaster(RepairRequest $repair, int $masterId)
    {
        $repair->update([
            'master_id' => $masterId,
            'status' => 'in_progress',
        ]);

        $this->logStatusChange($repair, 'in_progress', 'Майстра призначено');

        $this->notificationService->sendStatusNotification(
            $repair->id,
            'Вашу заявку взято в роботу'
        );
    }

    public function updateStatus(RepairRequest $repair, string $status, ?string $comment = null)
    {
        $repair->update(['status' => $status]);

        if ($status === 'completed') {
            $repair->update(['completed_at' => now()]);
        }

        $this->logStatusChange($repair, $status, $comment ?? "Статус змінено на {$status}");

        $this->notificationService->sendStatusNotification(
            $repair->id,
            "Статус заявки змінено: {$status}"
        );
    }

    protected function logStatusChange(RepairRequest $repair, string $status, string $comment)
    {
        RepairStatus::create([
            'repair_request_id' => $repair->id,
            'status' => $status,
            'comment' => $comment,
            'changed_by' => auth()->id(),
        ]);
    }
}
