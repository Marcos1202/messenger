<?php

use App\User;
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
        User::create([
            'name' => 'Juan',
            'email' => 'admin@admin.org',
            'password' => bcrypt('123123123')
        ]);

        User::create([
            'name' => 'Marcos',
            'email' => 'user@admin.org',
            'password' => bcrypt('123123123')
        ]);

        User::create([
            'name' => 'Mar',
            'email' => 'castro@admin.org',
            'password' => bcrypt('123123123')
        ]);
    }
}
