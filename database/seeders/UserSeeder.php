<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MasterProfile;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@repair.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+380501234567',
        ]);

        $master1 = User::create([
            'name' => 'Іван Петренко',
            'email' => 'master1@repair.com',
            'password' => Hash::make('password'),
            'role' => 'master',
            'phone' => '+380501234568',
        ]);

        MasterProfile::create([
            'user_id' => $master1->id,
            'specialization' => 'Ремонт побутової техніки',
            'experience_years' => 5,
            'average_rating' => 4.5,
            'total_repairs' => 0,
        ]);

        $master2 = User::create([
            'name' => 'Олена Коваленко',
            'email' => 'master2@repair.com',
            'password' => Hash::make('password'),
            'role' => 'master',
            'phone' => '+380501234569',
        ]);

        MasterProfile::create([
            'user_id' => $master2->id,
            'specialization' => 'Ремонт електроніки',
            'experience_years' => 3,
            'average_rating' => 4.8,
            'total_repairs' => 0,
        ]);

        $client1 = User::create([
            'name' => 'Петро Сидоренко',
            'email' => 'client1@repair.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'phone' => '+380501234570',
        ]);

        $client2 = User::create([
            'name' => 'Марія Ткаченко',
            'email' => 'client2@repair.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'phone' => '+380501234571',
        ]);
    }
}
