<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RepairRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            if ($request->status === 'blocked') {
                $query->whereNotNull('blocked_at');
            } else {
                $query->whereNull('blocked_at');
            }
        }

        $users = $query->withCount(['repairRequests', 'masterRepairs', 'receivedReviews'])
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function blockUser(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Неможливо заблокувати адміністратора');
        }

        $user->block();
        return back()->with('success', "Користувача {$user->name} заблоковано");
    }

    public function unblockUser(User $user)
    {
        $user->unblock();
        return back()->with('success', "Користувача {$user->name} розблоковано");
    }

    public function reports()
    {
        $totalUsers = User::count();
        $clientsCount = User::where('role', 'client')->count();
        $mastersCount = User::where('role', 'master')->count();
        $blockedUsers = User::whereNotNull('blocked_at')->count();

        $totalRepairs = RepairRequest::count();
        $newRepairs = RepairRequest::where('status', 'new')->count();
        $inProgressRepairs = RepairRequest::where('status', 'in_progress')->count();
        $completedRepairs = RepairRequest::where('status', 'completed')->count();

        $totalReviews = Review::count();
        $averageRating = Review::avg('rating');

        $monthlyRepairs = RepairRequest::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $topMasters = User::where('role', 'master')
            ->withCount('masterRepairs')
            ->withAvg('receivedReviews', 'rating')
            ->orderBy('master_repairs_count', 'desc')
            ->limit(10)
            ->get();

        $recentActivity = RepairRequest::with(['client', 'master'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.reports', compact(
            'totalUsers', 'clientsCount', 'mastersCount', 'blockedUsers',
            'totalRepairs', 'newRepairs', 'inProgressRepairs', 'completedRepairs',
            'totalReviews', 'averageRating', 'monthlyRepairs', 'topMasters', 'recentActivity'
        ));
    }
}
