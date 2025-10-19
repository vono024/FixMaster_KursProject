<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function clientDashboard()
    {
        $activeRequests = RepairRequest::where('client_id', auth()->id())
            ->whereIn('status', ['new', 'in_progress'])
            ->with('master')
            ->get();

        $recentRequests = RepairRequest::where('client_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.client', compact('activeRequests', 'recentRequests'));
    }

    public function masterDashboard()
    {
        $assignedRequests = RepairRequest::where('master_id', auth()->id())
            ->whereIn('status', ['in_progress'])
            ->with('client')
            ->get();

        $newRequests = RepairRequest::where('status', 'new')
            ->whereNull('master_id')
            ->get();

        $completedToday = RepairRequest::where('master_id', auth()->id())
            ->where('status', 'completed')
            ->whereDate('completed_at', today())
            ->count();

        $avgRating = Review::where('master_id', auth()->id())->avg('rating');

        return view('dashboard.master', compact('assignedRequests', 'newRequests', 'completedToday', 'avgRating'));
    }

    public function adminDashboard()
    {
        $totalRequests = RepairRequest::count();
        $activeRequests = RepairRequest::whereIn('status', ['new', 'in_progress'])->count();
        $completedRequests = RepairRequest::where('status', 'completed')->count();

        $totalMasters = User::where('role', 'master')->count();
        $totalClients = User::where('role', 'client')->count();

        $recentRequests = RepairRequest::with(['client', 'master'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard.admin', compact(
            'totalRequests',
            'activeRequests',
            'completedRequests',
            'totalMasters',
            'totalClients',
            'recentRequests'
        ));
    }
}
