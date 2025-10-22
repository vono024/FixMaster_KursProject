<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Http\Requests\UpdateMasterProfileRequest;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        $masters = User::where('role', 'master')
            ->where('profile_completed', true)
            ->withCount(['assignedRepairs as completed_count' => function($query) {
                $query->where('status', 'completed');
            }])
            ->withAvg('receivedReviews', 'rating')
            ->paginate(12);

        return view('masters.index', compact('masters'));
    }

    public function show(User $master)
    {
        if ($master->role !== 'master') {
            abort(404);
        }

        $master->load(['receivedReviews.client', 'assignedRepairs']);

        $completedCount = $master->assignedRepairs()->where('status', 'completed')->count();
        $averageRating = $master->receivedReviews()->avg('rating') ?? 0;

        return view('masters.show', compact('master', 'completedCount', 'averageRating'));
    }

    public function setupForm()
    {
        $user = auth()->user();

        if ($user->role !== 'master') {
            abort(403);
        }

        return view('profile.master-setup');
    }

    public function updateProfile(UpdateMasterProfileRequest $request)
    {
        $user = auth()->user();

        if ($user->role !== 'master') {
            abort(403);
        }

        $user->update([
            'specialization' => $request->specialization,
            'bio' => $request->bio,
            'hourly_rate' => $request->hourly_rate,
            'phone' => $request->phone,
            'profile_completed' => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Профіль майстра налаштовано!');
    }
}
