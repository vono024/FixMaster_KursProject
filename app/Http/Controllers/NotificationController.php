<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())
            ->findOrFail($id);

        $notification->update(['is_read' => true]);

        return redirect()->back();
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Всі повідомлення прочитано');
    }

    public function sendStatusNotification($repairRequestId, $message)
    {
        $repairRequest = \App\Models\RepairRequest::findOrFail($repairRequestId);

        Notification::create([
            'user_id' => $repairRequest->client_id,
            'repair_request_id' => $repairRequestId,
            'type' => 'status_change',
            'message' => $message,
            'sent_at' => now(),
        ]);
    }
}
