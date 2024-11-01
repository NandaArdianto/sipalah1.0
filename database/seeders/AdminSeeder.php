<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'username' => 'BPP Kasihan',
            'email' => 'bppkasihan@kasihan.go.id',
            'password' => Hash::make('bppkasihan2024'),
            'foto_profile' => '', // Ganti jika perlu
        ]);
    }
}

