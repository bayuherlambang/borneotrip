<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UsersLevel;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        UsersLevel::create([
            'name' => 'Administrator'
        ]);

        UsersLevel::create([
            'name' => 'User'
        ]);

        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'level_id' => 1,
            'fullname' => "Super Admin",
            'email'=> "admin@admin.com"
        ]);


        \App\CategoryPosts::create([
            'name' =>'Paket Trip'
        ]);

        \App\CategoryPosts::create([
            'name' =>'Destinasi Kuliner'
        ]);

        \App\CategoryPosts::create([
            'name' => 'Event'
        ]);

        \App\CategoryPosts::create([
            'name' => 'Profil'
        ]);
    }
}
