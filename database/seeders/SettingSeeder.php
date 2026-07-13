<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'full_name' => 'Mohan Kalavalapalli',
            'title' => 'Laravel Full Stack Developer',
            'email' => 'kalavalapallimohan9@gmail.com',
            'phone' => '7981031675',
            'location' => 'India',
            'about' => 'Laravel Developer with 3+ years experience.',
            'github' => 'https://github.com/KalavalapalliMohan',
            'linkedin' => 'https://www.linkedin.com/in/mohan-kalavalapalli-7a3309259/',
        ]);
    }
}
