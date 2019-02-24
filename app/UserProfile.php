<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'gender', 'phone', 
        'address', 'cv_path' , 'cv_status'
    ];

    // Relasi 1 user hanya memiliki 1 profile
    public function user() 
    { 
        return $this->belongsTo(User::class); 
    }
 


    
}
