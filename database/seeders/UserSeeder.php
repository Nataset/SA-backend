<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('1234');
        $admin->role = 'admin';
        $admin->address = "admin address";
        $admin->firstname = "admin";
        $admin->lastname = "admin";
        $admin->save();

        $user = new User;
        $user->email = 'test@test.com';
        $user->password = bcrypt('1234');
        $user->role = 'user';
        $user->address = "test address";
        $user->firstname = "test";
        $user->lastname = "test";
        $user->save();
    }
}
