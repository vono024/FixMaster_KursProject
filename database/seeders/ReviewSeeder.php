<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@repair.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'profile_completed' => true,
        ]);

        User::create([
            'name' => 'Іван Петренко',
            'email' => 'master1@repair.com',
            'password' => Hash::make('password'),
            'role' => 'master',
            'phone' => '+380501234567',
            'specialization' => 'Ремонт комп\'ютерів та ноутбуків',
            'bio' => 'Професійний майстер з ремонту комп\'ютерної техніки. Досвід роботи понад 5 років. Швидко та якісно виконую ремонт будь-якої складності.',
            'hourly_rate' => 250.00,
            'profile_completed' => true,
        ]);

        User::create([
            'name' => 'Олена Коваленко',
            'email' => 'master2@repair.com',
            'password' => Hash::make('password'),
            'role' => 'master',
            'phone' => '+380502345678',
            'specialization' => 'Ремонт мобільних телефонів та планшетів',
            'bio' => 'Спеціалізуюсь на ремонті смартфонів та планшетів усіх виробників. Використовую тільки оригінальні комплектуючі. Гарантія на всі роботи.',
            'hourly_rate' => 200.00,
            'profile_completed' => true,
        ]);

        User::create([
            'name' => 'Микола Сидоренко',
            'email' => 'master3@repair.com',
            'password' => Hash::make('password'),
            'role' => 'master',
            'phone' => '+380503456789',
            'specialization' => 'Ремонт побутової техніки',
            'bio' => 'Ремонтую пральні машини, холодильники, мікрохвильовки та іншу побутову техніку. Виїзд на дім. Діагностика безкоштовна.',
            'hourly_rate' => 300.00,
            'profile_completed' => true,
        ]);

        User::create([
            'name' => 'Клієнт Тестовий',
            'email' => 'client1@repair.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'phone' => '+380504567890',
            'profile_completed' => true,
        ]);

        User::create([
            'name' => 'Марія Іванова',
            'email' => 'client2@repair.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'phone' => '+380505678901',
            'profile_completed' => true,
        ]);
    }
}
