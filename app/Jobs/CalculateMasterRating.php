<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\RatingService;

class CalculateMasterRating implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $masterId;

    public function __construct(int $masterId)
    {
        $this->masterId = $masterId;
    }

    public function handle(RatingService $ratingService)
    {
        $ratingService->updateMasterRating($this->masterId);
    }
}
