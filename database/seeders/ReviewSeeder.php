<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\RepairRequest;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $completedRepairs = RepairRequest::where('status', 'completed')->get();

        foreach ($completedRepairs as $repair) {
            Review::create([
                'repair_request_id' => $repair->id,
                'client_id' => $repair->client_id,
                'master_id' => $repair->master_id,
                'rating' => rand(4, 5),
                'comment' => 'Чудова робота! Все швидко та якісно.',
            ]);
        }
    }
}
