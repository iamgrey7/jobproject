<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('user_id');           
           $table->string('first_name');
           $table->string('last_name')->nullable();
           $table->string('gender');
           $table->integer('phone');
           $table->string('address');            
           $table->string('cv_path')->nullable();
           $table->string('cv_status')->default('Unread');           
           $table->timestamps();                      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}

