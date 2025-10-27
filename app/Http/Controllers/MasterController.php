<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'master')
            ->whereNotNull('specialization')
            ->whereNotNull('bio');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('specialization', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        if ($request->filled('specialization')) {
            $query->where('specialization', 'like', "%{$request->specialization}%");
        }

        if ($request->filled('max_rate')) {
            $query->where('hourly_rate', '<=', $request->max_rate);
        }

        $query->withCount('receivedReviews')
            ->addSelect([
                'completed_count' => \DB::table('repair_requests')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('master_id', 'users.id')
                    ->where('status', 'completed')
            ])
            ->withAvg('receivedReviews', 'rating');

        switch ($request->input('sort', 'rating')) {
            case 'rating':
                $query->orderByDesc('received_reviews_avg_rating')
                    ->orderByDesc('received_reviews_count');
                break;
            case 'reviews':
                $query->orderByDesc('received_reviews_count');
                break;
            case 'completed':
                $query->orderByDesc('completed_count');
                break;
            case 'price_low':
                $query->orderBy('hourly_rate', 'asc');
                break;
            case 'price_high':
                $query->orderByDesc('hourly_rate');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $masters = $query->paginate(12)->withQueryString();

        $specializations = User::where('role', 'master')
            ->whereNotNull('specialization')
            ->distinct()
            ->pluck('specialization');

        return view('masters.index', compact('masters', 'specializations'));
    }

    public function show(User $master)
    {
        if ($master->role !== 'master') {
            abort(404);
        }

        $master->load('receivedReviews.client', 'receivedReviews.repairRequest');

        $averageRating = $master->receivedReviews->avg('rating') ?? 0;
        $completedCount = \App\Models\RepairRequest::where('master_id', $master->id)
            ->where('status', 'completed')
            ->count();

        return view('masters.show', compact('master', 'averageRating', 'completedCount'));
    }

    public function setupForm()
    {
        return view('profile.master-setup');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'specialization' => 'required|string|max:255',
            'bio' => 'required|string|min:50',
            'hourly_rate' => 'required|numeric|min:0',
            'phone' => 'required|string|max:20',
        ]);

        $user = $request->user();
        $user->specialization = $request->specialization;
        $user->bio = $request->bio;
        $user->hourly_rate = $request->hourly_rate;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Профіль успішно налаштовано');
    }
}
