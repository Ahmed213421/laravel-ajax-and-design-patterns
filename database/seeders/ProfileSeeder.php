<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::insert([
            'name' => 'ahmed samir',
            'email' => 'ahmed@gm',
            'password' => Hash::make('12345678'),
            'photo' => 'avatar.jpg'
        ]);
    }
}
