<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create(['email' => 'khanh@gmail.com', 'password' => Hash::make('123456'), 'name' => 'khanh']);
        Color::insert([['name' => 'Đỏ'], ['name' => 'Đen'], ['name' => 'Vàng'], ['name' => 'Xanh'], ['name' => 'Tím'], ['name' => 'Bạch kim'], ['name' => 'Trắng'], ['name' => 'Bạc']]);
    }
}
