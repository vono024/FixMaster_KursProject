<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        $masters = User::where('role', 'master')
            ->whereNotNull('specialization')
            ->whereNotNull('bio')
            ->withCount('receivedReviews')
            ->withAvg('receivedReviews', 'rating')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('masters.index', compact('masters'));
    }

    public function show(User $master)
    {
        if ($master->role !== 'master') {
            abort(404);
        }

        $master->load('receivedReviews.client', 'receivedReviews.repairRequest');

        $averageRating = $master->receivedReviews->avg('rating') ?? 0;

        // Прямий запит до бази
        $completedCount = \App\Models\RepairRequest::where('master_id', $master->id)
            ->where('status', 'completed')
            ->count();

        return view('masters.show', compact('master', 'averageRating', 'completedCount'));
    }
}
