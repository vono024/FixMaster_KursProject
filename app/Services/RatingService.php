<?php

namespace App\Services;

use App\Models\Review;
use App\Models\MasterProfile;

class RatingService
{
    public function updateMasterRating(int $masterId)
    {
        $avgRating = Review::where('master_id', $masterId)->avg('rating');
        $totalReviews = Review::where('master_id', $masterId)->count();

        MasterProfile::updateOrCreate(
            ['user_id' => $masterId],
            [
                'average_rating' => round($avgRating, 2),
                'total_repairs' => $totalReviews,
            ]
        );

        return $avgRating;
    }

    public function getMasterRating(int $masterId)
    {
        $profile = MasterProfile::where('user_id', $masterId)->first();

        return $profile ? $profile->average_rating : 0;
    }

    public function getTopMasters(int $limit = 10)
    {
        return MasterProfile::with('user')
            ->where('average_rating', '>', 0)
            ->orderBy('average_rating', 'desc')
            ->orderBy('total_repairs', 'desc')
            ->limit($limit)
            ->get();
    }
}
