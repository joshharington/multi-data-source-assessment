<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Insert Demo User
        $user = new User;
        $user->name = "Josh";
        $user->email = "josh1@live.co.za";
        $user->password = Hash::make('12345678a!');
        $user->save();
    }
}
