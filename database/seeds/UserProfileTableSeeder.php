<?php

use Illuminate\Database\Seeder;

use App\UserProfile;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grey = new UserProfile;
        $grey->user_id = '2';
        $grey->first_name = 'Egry';
        $grey->last_name = 'Yudanegara';
        $grey->gender = 'Pria';
        $grey->phone = '0899';
        $grey->address = 'Banjaran'; 
        $grey->save();  
    }
}
