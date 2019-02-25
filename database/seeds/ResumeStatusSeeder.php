<?php

use Illuminate\Database\Seeder;

use App\ResumeStatus;

class ResumeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unread = new ResumeStatus;       
        $unread->status_desc = 'Unread';
        $unread->save();

        $processed = new ResumeStatus;        
        $processed->status_desc = 'Sedang Diproses';
        $processed->save();

        $accepted = new ResumeStatus;        
        $accepted->status_desc = 'Lamaran Diterima';
        $accepted->save();

        $rejected = new ResumeStatus;        
        $rejected->status_desc = 'Lamaran Ditolak';
        $rejected->save();

    }
}
