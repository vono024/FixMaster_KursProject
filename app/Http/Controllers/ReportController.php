<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function generalStats()
    {
        $totalRequests = RepairRequest::count();
        $completedRequests = RepairRequest::where('status', 'completed')->count();
        $inProgressRequests = RepairRequest::where('status', 'in_progress')->count();
        $newRequests = RepairRequest::where('status', 'new')->count();
        $assignedRequests = RepairRequest::where('status', 'assigned')->count();

        $totalRevenue = RepairRequest::where('status', 'completed')
            ->whereNotNull('final_cost')
            ->sum('final_cost');

        $avgCompletionTime = RepairRequest::where('status', 'completed')
            ->whereNotNull('completed_at')
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, completed_at)) as avg_time')
            ->first()
            ->avg_time;

        $topMasters = User::where('role', 'master')
            ->withCount(['assignedRepairs as completed_count' => function($query) {
                $query->where('status', 'completed');
            }])
            ->with('receivedReviews')
            ->orderBy('completed_count', 'desc')
            ->limit(5)
            ->get();

        $monthlyStats = RepairRequest::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $totalClients = User::where('role', 'client')->count();
        $totalMasters = User::where('role', 'master')->count();

        return view('reports.statistics', compact(
            'totalRequests',
            'completedRequests',
            'inProgressRequests',
            'newRequests',
            'assignedRequests',
            'totalRevenue',
            'avgCompletionTime',
            'topMasters',
            'monthlyStats',
            'totalClients',
            'totalMasters'
        ));
    }

    public function masterStats($masterId)
    {
        $master = User::findOrFail($masterId);

        $completedRepairs = RepairRequest::where('master_id', $masterId)
            ->where('status', 'completed')
            ->count();

        $totalEarnings = RepairRequest::where('master_id', $masterId)
            ->where('status', 'completed')
            ->sum('final_cost');

        $avgRating = Review::where('master_id', $masterId)->avg('rating');

        $monthlyStats = RepairRequest::where('master_id', $masterId)
            ->where('status', 'completed')
            ->whereYear('completed_at', Carbon::now()->year)
            ->selectRaw('MONTH(completed_at) as month, COUNT(*) as count, SUM(final_cost) as revenue')
            ->groupBy('month')
            ->get();

        return view('reports.master-stats', compact(
            'master',
            'completedRepairs',
            'totalEarnings',
            'avgRating',
            'monthlyStats'
        ));
    }

    public function clientHistory($clientId)
    {
        $client = User::findOrFail($clientId);

        $repairs = RepairRequest::where('client_id', $clientId)
            ->with('master')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSpent = RepairRequest::where('client_id', $clientId)
            ->where('status', 'completed')
            ->sum('final_cost');

        return view('reports.history', compact('client', 'repairs', 'totalSpent'));
    }

    public function exportReport(Request $request)
    {
        $format = $request->input('format', 'pdf');

        return response()->json(['message' => 'Експорт у розробці']);
    }
}
