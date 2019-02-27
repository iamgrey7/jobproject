<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\ResumeStatus;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'gender', 'phone', 
        'address', 'cv_path' , 'cv_status'
    ];

    // Relationships
    public function user() 
    { 
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function cvStatus() 
    { 
        return $this->belongsTo(ResumeStatus::class, 'cv_status'); 
    }
 


    
}
