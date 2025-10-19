<?php

namespace App\Listeners;

use App\Events\ReviewSubmitted;
use App\Services\RatingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateMasterRating implements ShouldQueue
{
    use InteractsWithQueue;

    protected $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    public function handle(ReviewSubmitted $event)
    {
        $this->ratingService->updateMasterRating($event->review->master_id);
    }
}
