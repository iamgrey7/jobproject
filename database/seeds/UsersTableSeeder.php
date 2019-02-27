<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->username = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin');
        $admin->dob = '2019/01/01';
        $admin->status_id = '1';
        $admin->role_id = '1';        
        $admin->path_foto = '';
        $admin->save();

        $grey = new User;
        $grey->username = 'grey';
        $grey->email = 'grey@gmail.com';
        $grey->password = bcrypt('admin');
        $grey->dob = '2019/01/01';
        $grey->status_id = '1';
        $grey->role_id = '2';        
        $grey->path_foto = '';
        $grey->save(); 
        
        $user = new User;
        $user->username = 'user';
        $user->email = 'user@gmail.com';
        $user->password = bcrypt('admin');
        $user->dob = '2019/01/01';
        $user->status_id = '1';
        $user->role_id = '2';      
        $user->path_foto = '';
        $user->save();  
    }
}
