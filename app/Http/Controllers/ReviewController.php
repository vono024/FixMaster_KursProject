<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\RepairRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, RepairRequest $repairRequest)
    {
        if ($repairRequest->client_id !== auth()->id()) {
            abort(403);
        }

        if ($repairRequest->status !== 'completed') {
            return back()->with('error', 'Можна залишити відгук тільки після завершення роботи');
        }

        if ($repairRequest->review) {
            return back()->with('error', 'Ви вже залишили відгук');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'repair_request_id' => $repairRequest->id,
            'client_id' => auth()->id(),
            'master_id' => $repairRequest->master_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('repairs.show', $repairRequest)->with('success', 'Дякуємо за відгук!');
    }

    public function index()
    {
        $reviews = Review::with(['client', 'master', 'repairRequest'])
            ->latest()
            ->paginate(20);

        return view('reviews.index', compact('reviews'));
    }

    public function getMasterReviews(User $master)
    {
        if ($master->role !== 'master') {
            abort(404);
        }

        $reviews = Review::where('master_id', $master->id)
            ->with(['client', 'repairRequest'])
            ->latest()
            ->paginate(10);

        return view('reviews.master', compact('reviews', 'master'));
    }
}
