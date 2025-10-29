<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'client') {
            return $this->clientDashboard();
        } elseif ($user->role === 'master') {
            return $this->masterDashboard();
        } elseif ($user->role === 'admin') {
            return $this->adminDashboard();
        }

        return redirect()->route('home');
    }

    public function clientDashboard()
    {
        $user = auth()->user();

        $activeRequests = RepairRequest::where('client_id', $user->id)
            ->whereIn('status', ['new', 'assigned', 'in_progress'])
            ->with('master')
            ->latest()
            ->get();

        $completedRequests = RepairRequest::where('client_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $pendingReviews = RepairRequest::where('client_id', $user->id)
            ->where('status', 'completed')
            ->doesntHave('reviews')
            ->count();

        return view('dashboard.client', compact('activeRequests', 'completedRequests', 'pendingReviews'));
    }

    public function masterDashboard()
    {
        $user = auth()->user();

        $assignedRequests = RepairRequest::where('master_id', $user->id)
            ->whereIn('status', ['assigned', 'in_progress'])
            ->with('client')
            ->latest()
            ->get();

        $completedCount = RepairRequest::where('master_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $completedToday = RepairRequest::where('master_id', $user->id)
            ->where('status', 'completed')
            ->whereDate('updated_at', Carbon::today())
            ->count();

        $averageRating = Review::whereHas('repairRequest', function($query) use ($user) {
            $query->where('master_id', $user->id);
        })->avg('rating') ?? 0;

        $newRequests = RepairRequest::where('status', 'new')
            ->with('client')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.master', compact('assignedRequests', 'completedCount', 'completedToday', 'averageRating', 'newRequests'));
    }

    public function adminDashboard()
    {
        $totalRequests = RepairRequest::count();
        $activeRequests = RepairRequest::whereIn('status', ['new', 'assigned', 'in_progress'])->count();
        $completedRequests = RepairRequest::where('status', 'completed')->count();

        $totalClients = User::where('role', 'client')->count();
        $totalMasters = User::where('role', 'master')->count();

        $recentRequests = RepairRequest::with(['client', 'master'])
            ->latest()
            ->take(10)
            ->get();

        $topMasters = User::where('role', 'master')
            ->withCount(['assignedRepairs as completed_count' => function($query) {
                $query->where('status', 'completed');
            }])
            ->orderByDesc('completed_count')
            ->take(5)
            ->get();

        $users = User::orderBy('created_at', 'desc')->paginate(20);

        return view('dashboard.admin', compact(
            'totalRequests',
            'activeRequests',
            'completedRequests',
            'totalClients',
            'totalMasters',
            'recentRequests',
            'topMasters',
            'users'
        ));
    }
}
