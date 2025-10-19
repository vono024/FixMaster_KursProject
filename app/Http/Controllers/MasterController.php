<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MasterProfile;
use App\Models\RepairRequest;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        $masters = User::where('role', 'master')
            ->with('masterProfile')
            ->paginate(12);

        return view('masters.index', compact('masters'));
    }

    public function show(User $master)
    {
        $master->load(['masterProfile', 'reviews.client']);

        $completedRepairs = RepairRequest::where('master_id', $master->id)
            ->where('status', 'completed')
            ->count();

        return view('masters.show', compact('master', 'completedRepairs'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'specialization' => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0',
        ]);

        $profile = MasterProfile::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return redirect()->back()->with('success', 'Профіль оновлено');
    }
}
