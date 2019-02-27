<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserProfileTableSeeder::class);
        $this->call(ResumeStatusSeeder::class);
        $this->call(StatusTableSeeder::class);
    }
}
