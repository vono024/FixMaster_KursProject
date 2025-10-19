<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RepairRequest;
use App\Models\User;

class RepairRequestSeeder extends Seeder
{
    public function run(): void
    {
        $clients = User::where('role', 'client')->get();
        $masters = User::where('role', 'master')->get();

        if ($clients->isEmpty() || $masters->isEmpty()) {
            return;
        }

        RepairRequest::create([
            'client_id' => $clients[0]->id,
            'master_id' => $masters[0]->id,
            'device_type' => 'Пральна машина',
            'device_brand' => 'Samsung',
            'device_model' => 'WW60J3263LW',
            'problem_description' => 'Не крутиться барабан, чути гул',
            'status' => 'in_progress',
            'priority' => 'high',
            'estimated_cost' => 1500.00,
        ]);

        RepairRequest::create([
            'client_id' => $clients[0]->id,
            'device_type' => 'Холодильник',
            'device_brand' => 'LG',
            'device_model' => 'GC-B247JVUV',
            'problem_description' => 'Не морозить морозильна камера',
            'status' => 'new',
            'priority' => 'medium',
        ]);

        if (isset($clients[1])) {
            RepairRequest::create([
                'client_id' => $clients[1]->id,
                'master_id' => $masters[0]->id,
                'device_type' => 'Телевізор',
                'device_brand' => 'Sony',
                'device_model' => 'KD-55X8505C',
                'problem_description' => 'Не вмикається, індикатор блимає червоним',
                'status' => 'completed',
                'priority' => 'low',
                'estimated_cost' => 2000.00,
                'final_cost' => 1800.00,
                'completed_at' => now()->subDays(2),
            ]);
        }
    }
}
