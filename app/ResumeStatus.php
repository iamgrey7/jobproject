<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserProfile;

class ResumeStatus extends Model
{
    protected $fillable = [
        'status_desc'
    ];

    // 1 role dapat dimiliki oleh banyak user
    public function userProfiles() 
    { 
        return $this->hasMany(UserProfile::class); 
    }

    
}
