<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@localhost',
                'email_verified_at' => now(),
                'role' => 'admin',
                'password' => bcrypt('admin'), // password
            ],
            [
                'name' => 'manager',
                'email' => 'manager@localhost',
                'email_verified_at' => now(),
                'role' => 'manager',
                'password' => bcrypt('manager'), // password
            ],
            [
                'name' => 'user',
                'email' => 'user@localhost',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => bcrypt('user'), // password
            ],

        ];
     \DB::table('users')->insert($data);
     User::factory(15)->create();
    }
}
