<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role;
        $admin->role_name = 'admin';
        $admin->description = 'Administrator dapat mengelola user, mengelola CV yg diupload User';
        $admin->save();

        $user = new Role;
        $user->role_name = 'user';
        $user->description = 'User wajib mengisi data diri dan mengupload CV untuk diperiksa oleh administrator';
        $user->save();

    }
}
