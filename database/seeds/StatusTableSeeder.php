<?php

use Illuminate\Database\Seeder;

use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $active = new Status;
        $active->acc_status = "Aktif";
        $active->save();

        $suspend = new Status;
        $suspend->acc_status = "Suspend";
        $suspend->save();

        $nonactive = new Status;
        $nonactive->acc_status = "Tidak Aktif";
        $nonactive->save();
    }
}
