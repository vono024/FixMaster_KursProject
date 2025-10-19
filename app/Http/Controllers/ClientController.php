<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function myRequests()
    {
        $requests = RepairRequest::where('client_id', auth()->id())
            ->with('master')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.requests', compact('requests'));
    }

    public function dashboard()
    {
        $activeRequests = RepairRequest::where('client_id', auth()->id())
            ->whereIn('status', ['new', 'in_progress'])
            ->count();

        $completedRequests = RepairRequest::where('client_id', auth()->id())
            ->where('status', 'completed')
            ->count();

        return view('dashboard.client', compact('activeRequests', 'completedRequests'));
    }
}
