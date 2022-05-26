<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->upsert([
            ['id' => 1,'name'=>'admin', 'email' => 'admin@email.com', 'mobile' => '0000000001', 'password' => Hash::make('password')],
        ], 'id');
    }
}
