<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Status extends Model
{
    protected $fillable = [
        'acc_status'
    ];

    // Relationships
    public function users() 
    { 
        return $this->hasMany(User::class, 'status_id'); 
    }

}
