<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\RepairRequest;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, RepairRequest $repairRequest)
    {
        $review = Review::create([
            'repair_request_id' => $repairRequest->id,
            'client_id' => auth()->id(),
            'master_id' => $repairRequest->master_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $this->updateMasterRating($repairRequest->master_id);

        return redirect()->back()->with('success', 'Відгук додано');
    }

    public function index()
    {
        $reviews = Review::with(['client', 'master', 'repairRequest'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('reviews.index', compact('reviews'));
    }

    public function getMasterReviews($masterId)
    {
        $reviews = Review::where('master_id', $masterId)
            ->with('client')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($reviews);
    }

    private function updateMasterRating($masterId)
    {
        $avgRating = Review::where('master_id', $masterId)->avg('rating');
        $totalReviews = Review::where('master_id', $masterId)->count();

        \App\Models\MasterProfile::where('user_id', $masterId)->update([
            'average_rating' => round($avgRating, 2),
            'total_repairs' => $totalReviews,
        ]);
    }
}
