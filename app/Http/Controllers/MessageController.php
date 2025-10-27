<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\RepairRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $repairRequests = \App\Models\RepairRequest::where(function($query) {
            if (auth()->user()->role === 'client') {
                $query->where('client_id', auth()->id());
            } else {
                $query->where('master_id', auth()->id());
            }
        })
            ->whereNotNull('master_id')
            ->with(['client', 'master', 'messages'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('messages.index', compact('repairRequests'));
    }

    public function show(RepairRequest $repair)
    {
        $user = auth()->user();

        if ($repair->client_id !== $user->id && $repair->master_id !== $user->id) {
            abort(403);
        }

        $messages = Message::where('repair_request_id', $repair->id)
            ->with(['sender', 'receiver'])
            ->oldest()
            ->get();

        Message::where('repair_request_id', $repair->id)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('messages.show', compact('repair', 'messages'));
    }

    public function store(Request $request, RepairRequest $repair)
    {
        $user = auth()->user();

        if ($repair->client_id !== $user->id && $repair->master_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $receiverId = $repair->client_id === $user->id ? $repair->master_id : $repair->client_id;

        Message::create([
            'repair_request_id' => $repair->id,
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Повідомлення надіслано!');
    }
}
