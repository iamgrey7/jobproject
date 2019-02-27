<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserProfile;

class ResumeStatus extends Model
{
    protected $fillable = [
        'status_desc'
    ];
    
    // Relationships
    public function userProfiles() 
    { 
        return $this->hasMany(UserProfile::class, 'cv_status'); 
    }

    
}
